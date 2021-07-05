<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsApiKeyRequest;
use App\Http\Requests\UpdateCmsApiKeyRequest;
use App\Repositories\CmsApiKeyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CmsApiKeyController extends AppBaseController
{
    /** @var  CmsApiKeyRepository */
    private $cmsApiKeyRepository;

    public function __construct(CmsApiKeyRepository $cmsApiKeyRepo)
    {
        $this->cmsApiKeyRepository = $cmsApiKeyRepo;
    }

    /**
     * Display a listing of the CmsApiKey.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cmsApiKeys = $this->cmsApiKeyRepository->all();

        return view('cms_api_keys.index')
            ->with('cmsApiKeys', $cmsApiKeys);
    }

    /**
     * Show the form for creating a new CmsApiKey.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_api_keys.create');
    }

    /**
     * Store a newly created CmsApiKey in storage.
     *
     * @param CreateCmsApiKeyRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsApiKeyRequest $request)
    {
        $input = $request->all();

        $cmsApiKey = $this->cmsApiKeyRepository->create($input);

        Flash::success('Cms Api Key saved successfully.');

        return redirect(route('cmsApiKeys.index'));
    }

    /**
     * Display the specified CmsApiKey.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsApiKey = $this->cmsApiKeyRepository->find($id);

        if (empty($cmsApiKey)) {
            Flash::error('Cms Api Key not found');

            return redirect(route('cmsApiKeys.index'));
        }

        return view('cms_api_keys.show')->with('cmsApiKey', $cmsApiKey);
    }

    /**
     * Show the form for editing the specified CmsApiKey.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsApiKey = $this->cmsApiKeyRepository->find($id);

        if (empty($cmsApiKey)) {
            Flash::error('Cms Api Key not found');

            return redirect(route('cmsApiKeys.index'));
        }

        return view('cms_api_keys.edit')->with('cmsApiKey', $cmsApiKey);
    }

    /**
     * Update the specified CmsApiKey in storage.
     *
     * @param int $id
     * @param UpdateCmsApiKeyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsApiKeyRequest $request)
    {
        $cmsApiKey = $this->cmsApiKeyRepository->find($id);

        if (empty($cmsApiKey)) {
            Flash::error('Cms Api Key not found');

            return redirect(route('cmsApiKeys.index'));
        }

        $cmsApiKey = $this->cmsApiKeyRepository->update($request->all(), $id);

        Flash::success('Cms Api Key updated successfully.');

        return redirect(route('cmsApiKeys.index'));
    }

    /**
     * Remove the specified CmsApiKey from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsApiKey = $this->cmsApiKeyRepository->find($id);

        if (empty($cmsApiKey)) {
            Flash::error('Cms Api Key not found');

            return redirect(route('cmsApiKeys.index'));
        }

        $this->cmsApiKeyRepository->delete($id);

        Flash::success('Cms Api Key deleted successfully.');

        return redirect(route('cmsApiKeys.index'));
    }
}
