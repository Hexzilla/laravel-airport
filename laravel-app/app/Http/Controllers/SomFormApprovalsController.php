<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomFormApprovalsRequest;
use App\Http\Requests\UpdateSomFormApprovalsRequest;
use App\Repositories\SomFormApprovalsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomFormApprovalsController extends AppBaseController
{
    /** @var  SomFormApprovalsRepository */
    private $somFormApprovalsRepository;

    public function __construct(SomFormApprovalsRepository $somFormApprovalsRepo)
    {
        $this->somFormApprovalsRepository = $somFormApprovalsRepo;
    }

    /**
     * Display a listing of the SomFormApprovals.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somFormApprovals = $this->somFormApprovalsRepository->all();

        return view('som_form_approvals.index')
            ->with('somFormApprovals', $somFormApprovals);
    }

    /**
     * Show the form for creating a new SomFormApprovals.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_form_approvals.create');
    }

    /**
     * Store a newly created SomFormApprovals in storage.
     *
     * @param CreateSomFormApprovalsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomFormApprovalsRequest $request)
    {
        $input = $request->all();

        $somFormApprovals = $this->somFormApprovalsRepository->create($input);

        Flash::success('Som Form Approvals saved successfully.');

        return redirect(route('somFormApprovals.index'));
    }

    /**
     * Display the specified SomFormApprovals.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somFormApprovals = $this->somFormApprovalsRepository->find($id);

        if (empty($somFormApprovals)) {
            Flash::error('Som Form Approvals not found');

            return redirect(route('somFormApprovals.index'));
        }

        return view('som_form_approvals.show')->with('somFormApprovals', $somFormApprovals);
    }

    /**
     * Show the form for editing the specified SomFormApprovals.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somFormApprovals = $this->somFormApprovalsRepository->find($id);

        if (empty($somFormApprovals)) {
            Flash::error('Som Form Approvals not found');

            return redirect(route('somFormApprovals.index'));
        }

        return view('som_form_approvals.edit')->with('somFormApprovals', $somFormApprovals);
    }

    /**
     * Update the specified SomFormApprovals in storage.
     *
     * @param int $id
     * @param UpdateSomFormApprovalsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomFormApprovalsRequest $request)
    {
        $somFormApprovals = $this->somFormApprovalsRepository->find($id);

        if (empty($somFormApprovals)) {
            Flash::error('Som Form Approvals not found');

            return redirect(route('somFormApprovals.index'));
        }

        $somFormApprovals = $this->somFormApprovalsRepository->update($request->all(), $id);

        Flash::success('Som Form Approvals updated successfully.');

        return redirect(route('somFormApprovals.index'));
    }

    /**
     * Remove the specified SomFormApprovals from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somFormApprovals = $this->somFormApprovalsRepository->find($id);

        if (empty($somFormApprovals)) {
            Flash::error('Som Form Approvals not found');

            return redirect(route('somFormApprovals.index'));
        }

        $this->somFormApprovalsRepository->delete($id);

        Flash::success('Som Form Approvals deleted successfully.');

        return redirect(route('somFormApprovals.index'));
    }
}
