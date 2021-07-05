<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectInfoStatusRequest;
use App\Http\Requests\UpdateSomProjectInfoStatusRequest;
use App\Repositories\SomProjectInfoStatusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectInfoStatusController extends AppBaseController
{
    /** @var  SomProjectInfoStatusRepository */
    private $somProjectInfoStatusRepository;

    public function __construct(SomProjectInfoStatusRepository $somProjectInfoStatusRepo)
    {
        $this->somProjectInfoStatusRepository = $somProjectInfoStatusRepo;
    }

    /**
     * Display a listing of the SomProjectInfoStatus.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somProjectInfoStatuses = $this->somProjectInfoStatusRepository->all();

        return view('som_project_info_statuses.index')
            ->with('somProjectInfoStatuses', $somProjectInfoStatuses);
    }

    /**
     * Show the form for creating a new SomProjectInfoStatus.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_project_info_statuses.create');
    }

    /**
     * Store a newly created SomProjectInfoStatus in storage.
     *
     * @param CreateSomProjectInfoStatusRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectInfoStatusRequest $request)
    {
        $input = $request->all();

        $somProjectInfoStatus = $this->somProjectInfoStatusRepository->create($input);

        Flash::success('Som Project Info Status saved successfully.');

        return redirect(route('somProjectInfoStatuses.index'));
    }

    /**
     * Display the specified SomProjectInfoStatus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectInfoStatus = $this->somProjectInfoStatusRepository->find($id);

        if (empty($somProjectInfoStatus)) {
            Flash::error('Som Project Info Status not found');

            return redirect(route('somProjectInfoStatuses.index'));
        }

        return view('som_project_info_statuses.show')->with('somProjectInfoStatus', $somProjectInfoStatus);
    }

    /**
     * Show the form for editing the specified SomProjectInfoStatus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectInfoStatus = $this->somProjectInfoStatusRepository->find($id);

        if (empty($somProjectInfoStatus)) {
            Flash::error('Som Project Info Status not found');

            return redirect(route('somProjectInfoStatuses.index'));
        }

        return view('som_project_info_statuses.edit')->with('somProjectInfoStatus', $somProjectInfoStatus);
    }

    /**
     * Update the specified SomProjectInfoStatus in storage.
     *
     * @param int $id
     * @param UpdateSomProjectInfoStatusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectInfoStatusRequest $request)
    {
        $somProjectInfoStatus = $this->somProjectInfoStatusRepository->find($id);

        if (empty($somProjectInfoStatus)) {
            Flash::error('Som Project Info Status not found');

            return redirect(route('somProjectInfoStatuses.index'));
        }

        $somProjectInfoStatus = $this->somProjectInfoStatusRepository->update($request->all(), $id);

        Flash::success('Som Project Info Status updated successfully.');

        return redirect(route('somProjectInfoStatuses.index'));
    }

    /**
     * Remove the specified SomProjectInfoStatus from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectInfoStatus = $this->somProjectInfoStatusRepository->find($id);

        if (empty($somProjectInfoStatus)) {
            Flash::error('Som Project Info Status not found');

            return redirect(route('somProjectInfoStatuses.index'));
        }

        $this->somProjectInfoStatusRepository->delete($id);

        Flash::success('Som Project Info Status deleted successfully.');

        return redirect(route('somProjectInfoStatuses.index'));
    }
}
