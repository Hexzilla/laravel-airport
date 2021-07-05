<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsStatisticComponentsRequest;
use App\Http\Requests\UpdateCmsStatisticComponentsRequest;
use App\Repositories\CmsStatisticComponentsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CmsStatisticComponentsController extends AppBaseController
{
    /** @var  CmsStatisticComponentsRepository */
    private $cmsStatisticComponentsRepository;

    public function __construct(CmsStatisticComponentsRepository $cmsStatisticComponentsRepo)
    {
        $this->cmsStatisticComponentsRepository = $cmsStatisticComponentsRepo;
    }

    /**
     * Display a listing of the CmsStatisticComponents.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cmsStatisticComponents = $this->cmsStatisticComponentsRepository->all();

        return view('cms_statistic_components.index')
            ->with('cmsStatisticComponents', $cmsStatisticComponents);
    }

    /**
     * Show the form for creating a new CmsStatisticComponents.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_statistic_components.create');
    }

    /**
     * Store a newly created CmsStatisticComponents in storage.
     *
     * @param CreateCmsStatisticComponentsRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsStatisticComponentsRequest $request)
    {
        $input = $request->all();

        $cmsStatisticComponents = $this->cmsStatisticComponentsRepository->create($input);

        Flash::success('Cms Statistic Components saved successfully.');

        return redirect(route('cmsStatisticComponents.index'));
    }

    /**
     * Display the specified CmsStatisticComponents.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsStatisticComponents = $this->cmsStatisticComponentsRepository->find($id);

        if (empty($cmsStatisticComponents)) {
            Flash::error('Cms Statistic Components not found');

            return redirect(route('cmsStatisticComponents.index'));
        }

        return view('cms_statistic_components.show')->with('cmsStatisticComponents', $cmsStatisticComponents);
    }

    /**
     * Show the form for editing the specified CmsStatisticComponents.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsStatisticComponents = $this->cmsStatisticComponentsRepository->find($id);

        if (empty($cmsStatisticComponents)) {
            Flash::error('Cms Statistic Components not found');

            return redirect(route('cmsStatisticComponents.index'));
        }

        return view('cms_statistic_components.edit')->with('cmsStatisticComponents', $cmsStatisticComponents);
    }

    /**
     * Update the specified CmsStatisticComponents in storage.
     *
     * @param int $id
     * @param UpdateCmsStatisticComponentsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsStatisticComponentsRequest $request)
    {
        $cmsStatisticComponents = $this->cmsStatisticComponentsRepository->find($id);

        if (empty($cmsStatisticComponents)) {
            Flash::error('Cms Statistic Components not found');

            return redirect(route('cmsStatisticComponents.index'));
        }

        $cmsStatisticComponents = $this->cmsStatisticComponentsRepository->update($request->all(), $id);

        Flash::success('Cms Statistic Components updated successfully.');

        return redirect(route('cmsStatisticComponents.index'));
    }

    /**
     * Remove the specified CmsStatisticComponents from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsStatisticComponents = $this->cmsStatisticComponentsRepository->find($id);

        if (empty($cmsStatisticComponents)) {
            Flash::error('Cms Statistic Components not found');

            return redirect(route('cmsStatisticComponents.index'));
        }

        $this->cmsStatisticComponentsRepository->delete($id);

        Flash::success('Cms Statistic Components deleted successfully.');

        return redirect(route('cmsStatisticComponents.index'));
    }
}
