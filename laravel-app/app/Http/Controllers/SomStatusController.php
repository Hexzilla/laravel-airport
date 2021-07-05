<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomStatusRequest;
use App\Http\Requests\UpdateSomStatusRequest;
use App\Repositories\SomStatusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomStatusController extends AppBaseController
{
    /** @var  SomStatusRepository */
    private $somStatusRepository;

    public function __construct(SomStatusRepository $somStatusRepo)
    {
        $this->somStatusRepository = $somStatusRepo;
    }

    /**
     * Display a listing of the SomStatus.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somStatuses = $this->somStatusRepository->all();

        return view('som_statuses.index')
            ->with('somStatuses', $somStatuses);
    }

    /**
     * Show the form for creating a new SomStatus.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_statuses.create');
    }

    /**
     * Store a newly created SomStatus in storage.
     *
     * @param CreateSomStatusRequest $request
     *
     * @return Response
     */
    public function store(CreateSomStatusRequest $request)
    {
        $input = $request->all();

        $somStatus = $this->somStatusRepository->create($input);

        Flash::success('Som Status saved successfully.');

        return redirect(route('somStatuses.index'));
    }

    /**
     * Display the specified SomStatus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somStatus = $this->somStatusRepository->find($id);

        if (empty($somStatus)) {
            Flash::error('Som Status not found');

            return redirect(route('somStatuses.index'));
        }

        return view('som_statuses.show')->with('somStatus', $somStatus);
    }

    /**
     * Show the form for editing the specified SomStatus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somStatus = $this->somStatusRepository->find($id);

        if (empty($somStatus)) {
            Flash::error('Som Status not found');

            return redirect(route('somStatuses.index'));
        }

        return view('som_statuses.edit')->with('somStatus', $somStatus);
    }

    /**
     * Update the specified SomStatus in storage.
     *
     * @param int $id
     * @param UpdateSomStatusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomStatusRequest $request)
    {
        $somStatus = $this->somStatusRepository->find($id);

        if (empty($somStatus)) {
            Flash::error('Som Status not found');

            return redirect(route('somStatuses.index'));
        }

        $somStatus = $this->somStatusRepository->update($request->all(), $id);

        Flash::success('Som Status updated successfully.');

        return redirect(route('somStatuses.index'));
    }

    /**
     * Remove the specified SomStatus from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somStatus = $this->somStatusRepository->find($id);

        if (empty($somStatus)) {
            Flash::error('Som Status not found');

            return redirect(route('somStatuses.index'));
        }

        $this->somStatusRepository->delete($id);

        Flash::success('Som Status deleted successfully.');

        return redirect(route('somStatuses.index'));
    }
}
