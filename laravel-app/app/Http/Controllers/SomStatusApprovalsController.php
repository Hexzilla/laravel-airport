<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomStatusApprovalsRequest;
use App\Http\Requests\UpdateSomStatusApprovalsRequest;
use App\Repositories\SomStatusApprovalsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomStatusApprovalsController extends AppBaseController
{
    /** @var  SomStatusApprovalsRepository */
    private $somStatusApprovalsRepository;

    public function __construct(SomStatusApprovalsRepository $somStatusApprovalsRepo)
    {
        $this->somStatusApprovalsRepository = $somStatusApprovalsRepo;
    }

    /**
     * Display a listing of the SomStatusApprovals.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somStatusApprovals = $this->somStatusApprovalsRepository->all();

        return view('som_status_approvals.index')
            ->with('somStatusApprovals', $somStatusApprovals);
    }

    /**
     * Show the form for creating a new SomStatusApprovals.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_status_approvals.create');
    }

    /**
     * Store a newly created SomStatusApprovals in storage.
     *
     * @param CreateSomStatusApprovalsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomStatusApprovalsRequest $request)
    {
        $input = $request->all();

        $somStatusApprovals = $this->somStatusApprovalsRepository->create($input);

        Flash::success('Som Status Approvals saved successfully.');

        return redirect(route('somStatusApprovals.index'));
    }

    /**
     * Display the specified SomStatusApprovals.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somStatusApprovals = $this->somStatusApprovalsRepository->find($id);

        if (empty($somStatusApprovals)) {
            Flash::error('Som Status Approvals not found');

            return redirect(route('somStatusApprovals.index'));
        }

        return view('som_status_approvals.show')->with('somStatusApprovals', $somStatusApprovals);
    }

    /**
     * Show the form for editing the specified SomStatusApprovals.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somStatusApprovals = $this->somStatusApprovalsRepository->find($id);

        if (empty($somStatusApprovals)) {
            Flash::error('Som Status Approvals not found');

            return redirect(route('somStatusApprovals.index'));
        }

        return view('som_status_approvals.edit')->with('somStatusApprovals', $somStatusApprovals);
    }

    /**
     * Update the specified SomStatusApprovals in storage.
     *
     * @param int $id
     * @param UpdateSomStatusApprovalsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomStatusApprovalsRequest $request)
    {
        $somStatusApprovals = $this->somStatusApprovalsRepository->find($id);

        if (empty($somStatusApprovals)) {
            Flash::error('Som Status Approvals not found');

            return redirect(route('somStatusApprovals.index'));
        }

        $somStatusApprovals = $this->somStatusApprovalsRepository->update($request->all(), $id);

        Flash::success('Som Status Approvals updated successfully.');

        return redirect(route('somStatusApprovals.index'));
    }

    /**
     * Remove the specified SomStatusApprovals from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somStatusApprovals = $this->somStatusApprovalsRepository->find($id);

        if (empty($somStatusApprovals)) {
            Flash::error('Som Status Approvals not found');

            return redirect(route('somStatusApprovals.index'));
        }

        $this->somStatusApprovalsRepository->delete($id);

        Flash::success('Som Status Approvals deleted successfully.');

        return redirect(route('somStatusApprovals.index'));
    }
}
