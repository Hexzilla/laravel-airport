<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsApiCustomRequest;
use App\Http\Requests\UpdateCmsApiCustomRequest;
use App\Repositories\CmsApiCustomRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CmsApiCustomController extends AppBaseController
{
    /** @var  CmsApiCustomRepository */
    private $cmsApiCustomRepository;

    public function __construct(CmsApiCustomRepository $cmsApiCustomRepo)
    {
        $this->cmsApiCustomRepository = $cmsApiCustomRepo;
    }

    /**
     * Display a listing of the CmsApiCustom.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cmsApiCustoms = $this->cmsApiCustomRepository->all();

        return view('cms_api_customs.index')
            ->with('cmsApiCustoms', $cmsApiCustoms);
    }

    /**
     * Show the form for creating a new CmsApiCustom.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_api_customs.create');
    }

    /**
     * Store a newly created CmsApiCustom in storage.
     *
     * @param CreateCmsApiCustomRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsApiCustomRequest $request)
    {
        $input = $request->all();

        $cmsApiCustom = $this->cmsApiCustomRepository->create($input);

        Flash::success('Cms Api Custom saved successfully.');

        return redirect(route('cmsApiCustoms.index'));
    }

    /**
     * Display the specified CmsApiCustom.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsApiCustom = $this->cmsApiCustomRepository->find($id);

        if (empty($cmsApiCustom)) {
            Flash::error('Cms Api Custom not found');

            return redirect(route('cmsApiCustoms.index'));
        }

        return view('cms_api_customs.show')->with('cmsApiCustom', $cmsApiCustom);
    }

    /**
     * Show the form for editing the specified CmsApiCustom.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsApiCustom = $this->cmsApiCustomRepository->find($id);

        if (empty($cmsApiCustom)) {
            Flash::error('Cms Api Custom not found');

            return redirect(route('cmsApiCustoms.index'));
        }

        return view('cms_api_customs.edit')->with('cmsApiCustom', $cmsApiCustom);
    }

    /**
     * Update the specified CmsApiCustom in storage.
     *
     * @param int $id
     * @param UpdateCmsApiCustomRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsApiCustomRequest $request)
    {
        $cmsApiCustom = $this->cmsApiCustomRepository->find($id);

        if (empty($cmsApiCustom)) {
            Flash::error('Cms Api Custom not found');

            return redirect(route('cmsApiCustoms.index'));
        }

        $cmsApiCustom = $this->cmsApiCustomRepository->update($request->all(), $id);

        Flash::success('Cms Api Custom updated successfully.');

        return redirect(route('cmsApiCustoms.index'));
    }

    /**
     * Remove the specified CmsApiCustom from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsApiCustom = $this->cmsApiCustomRepository->find($id);

        if (empty($cmsApiCustom)) {
            Flash::error('Cms Api Custom not found');

            return redirect(route('cmsApiCustoms.index'));
        }

        $this->cmsApiCustomRepository->delete($id);

        Flash::success('Cms Api Custom deleted successfully.');

        return redirect(route('cmsApiCustoms.index'));
    }
}
