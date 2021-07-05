<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsStatisticsRequest;
use App\Http\Requests\UpdateCmsStatisticsRequest;
use App\Repositories\CmsStatisticsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CmsStatisticsController extends AppBaseController
{
    /** @var  CmsStatisticsRepository */
    private $cmsStatisticsRepository;

    public function __construct(CmsStatisticsRepository $cmsStatisticsRepo)
    {
        $this->cmsStatisticsRepository = $cmsStatisticsRepo;
    }

    /**
     * Display a listing of the CmsStatistics.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cmsStatistics = $this->cmsStatisticsRepository->all();

        return view('cms_statistics.index')
            ->with('cmsStatistics', $cmsStatistics);
    }

    /**
     * Show the form for creating a new CmsStatistics.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_statistics.create');
    }

    /**
     * Store a newly created CmsStatistics in storage.
     *
     * @param CreateCmsStatisticsRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsStatisticsRequest $request)
    {
        $input = $request->all();

        $cmsStatistics = $this->cmsStatisticsRepository->create($input);

        Flash::success('Cms Statistics saved successfully.');

        return redirect(route('cmsStatistics.index'));
    }

    /**
     * Display the specified CmsStatistics.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsStatistics = $this->cmsStatisticsRepository->find($id);

        if (empty($cmsStatistics)) {
            Flash::error('Cms Statistics not found');

            return redirect(route('cmsStatistics.index'));
        }

        return view('cms_statistics.show')->with('cmsStatistics', $cmsStatistics);
    }

    /**
     * Show the form for editing the specified CmsStatistics.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsStatistics = $this->cmsStatisticsRepository->find($id);

        if (empty($cmsStatistics)) {
            Flash::error('Cms Statistics not found');

            return redirect(route('cmsStatistics.index'));
        }

        return view('cms_statistics.edit')->with('cmsStatistics', $cmsStatistics);
    }

    /**
     * Update the specified CmsStatistics in storage.
     *
     * @param int $id
     * @param UpdateCmsStatisticsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsStatisticsRequest $request)
    {
        $cmsStatistics = $this->cmsStatisticsRepository->find($id);

        if (empty($cmsStatistics)) {
            Flash::error('Cms Statistics not found');

            return redirect(route('cmsStatistics.index'));
        }

        $cmsStatistics = $this->cmsStatisticsRepository->update($request->all(), $id);

        Flash::success('Cms Statistics updated successfully.');

        return redirect(route('cmsStatistics.index'));
    }

    /**
     * Remove the specified CmsStatistics from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsStatistics = $this->cmsStatisticsRepository->find($id);

        if (empty($cmsStatistics)) {
            Flash::error('Cms Statistics not found');

            return redirect(route('cmsStatistics.index'));
        }

        $this->cmsStatisticsRepository->delete($id);

        Flash::success('Cms Statistics deleted successfully.');

        return redirect(route('cmsStatistics.index'));
    }
}
