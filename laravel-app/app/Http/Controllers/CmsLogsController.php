<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsLogsRequest;
use App\Http\Requests\UpdateCmsLogsRequest;
use App\Repositories\CmsLogsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CmsLogsController extends AppBaseController
{
    /** @var  CmsLogsRepository */
    private $cmsLogsRepository;

    public function __construct(CmsLogsRepository $cmsLogsRepo)
    {
        $this->cmsLogsRepository = $cmsLogsRepo;
    }

    /**
     * Display a listing of the CmsLogs.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cmsLogs = $this->cmsLogsRepository->all();

        return view('cms_logs.index')
            ->with('cmsLogs', $cmsLogs);
    }

    /**
     * Show the form for creating a new CmsLogs.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_logs.create');
    }

    /**
     * Store a newly created CmsLogs in storage.
     *
     * @param CreateCmsLogsRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsLogsRequest $request)
    {
        $input = $request->all();

        $cmsLogs = $this->cmsLogsRepository->create($input);

        Flash::success('Cms Logs saved successfully.');

        return redirect(route('cmsLogs.index'));
    }

    /**
     * Display the specified CmsLogs.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsLogs = $this->cmsLogsRepository->find($id);

        if (empty($cmsLogs)) {
            Flash::error('Cms Logs not found');

            return redirect(route('cmsLogs.index'));
        }

        return view('cms_logs.show')->with('cmsLogs', $cmsLogs);
    }

    /**
     * Show the form for editing the specified CmsLogs.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsLogs = $this->cmsLogsRepository->find($id);

        if (empty($cmsLogs)) {
            Flash::error('Cms Logs not found');

            return redirect(route('cmsLogs.index'));
        }

        return view('cms_logs.edit')->with('cmsLogs', $cmsLogs);
    }

    /**
     * Update the specified CmsLogs in storage.
     *
     * @param int $id
     * @param UpdateCmsLogsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsLogsRequest $request)
    {
        $cmsLogs = $this->cmsLogsRepository->find($id);

        if (empty($cmsLogs)) {
            Flash::error('Cms Logs not found');

            return redirect(route('cmsLogs.index'));
        }

        $cmsLogs = $this->cmsLogsRepository->update($request->all(), $id);

        Flash::success('Cms Logs updated successfully.');

        return redirect(route('cmsLogs.index'));
    }

    /**
     * Remove the specified CmsLogs from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsLogs = $this->cmsLogsRepository->find($id);

        if (empty($cmsLogs)) {
            Flash::error('Cms Logs not found');

            return redirect(route('cmsLogs.index'));
        }

        $this->cmsLogsRepository->delete($id);

        Flash::success('Cms Logs deleted successfully.');

        return redirect(route('cmsLogs.index'));
    }
}
