<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsSettingsRequest;
use App\Http\Requests\UpdateCmsSettingsRequest;
use App\Repositories\CmsSettingsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CmsSettingsController extends AppBaseController
{
    /** @var  CmsSettingsRepository */
    private $cmsSettingsRepository;

    public function __construct(CmsSettingsRepository $cmsSettingsRepo)
    {
        $this->cmsSettingsRepository = $cmsSettingsRepo;
    }

    /**
     * Display a listing of the CmsSettings.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cmsSettings = $this->cmsSettingsRepository->all();

        return view('cms_settings.index')
            ->with('cmsSettings', $cmsSettings);
    }

    /**
     * Show the form for creating a new CmsSettings.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_settings.create');
    }

    /**
     * Store a newly created CmsSettings in storage.
     *
     * @param CreateCmsSettingsRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsSettingsRequest $request)
    {
        $input = $request->all();

        $cmsSettings = $this->cmsSettingsRepository->create($input);

        Flash::success('Cms Settings saved successfully.');

        return redirect(route('cmsSettings.index'));
    }

    /**
     * Display the specified CmsSettings.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsSettings = $this->cmsSettingsRepository->find($id);

        if (empty($cmsSettings)) {
            Flash::error('Cms Settings not found');

            return redirect(route('cmsSettings.index'));
        }

        return view('cms_settings.show')->with('cmsSettings', $cmsSettings);
    }

    /**
     * Show the form for editing the specified CmsSettings.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsSettings = $this->cmsSettingsRepository->find($id);

        if (empty($cmsSettings)) {
            Flash::error('Cms Settings not found');

            return redirect(route('cmsSettings.index'));
        }

        return view('cms_settings.edit')->with('cmsSettings', $cmsSettings);
    }

    /**
     * Update the specified CmsSettings in storage.
     *
     * @param int $id
     * @param UpdateCmsSettingsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsSettingsRequest $request)
    {
        $cmsSettings = $this->cmsSettingsRepository->find($id);

        if (empty($cmsSettings)) {
            Flash::error('Cms Settings not found');

            return redirect(route('cmsSettings.index'));
        }

        $cmsSettings = $this->cmsSettingsRepository->update($request->all(), $id);

        Flash::success('Cms Settings updated successfully.');

        return redirect(route('cmsSettings.index'));
    }

    /**
     * Remove the specified CmsSettings from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsSettings = $this->cmsSettingsRepository->find($id);

        if (empty($cmsSettings)) {
            Flash::error('Cms Settings not found');

            return redirect(route('cmsSettings.index'));
        }

        $this->cmsSettingsRepository->delete($id);

        Flash::success('Cms Settings deleted successfully.');

        return redirect(route('cmsSettings.index'));
    }
}
