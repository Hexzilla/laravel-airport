<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomApprovalsResponsibleRequest;
use App\Http\Requests\UpdateSomApprovalsResponsibleRequest;
use App\Repositories\SomApprovalsResponsibleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomApprovalsResponsibleController extends AppBaseController
{
    /** @var  SomApprovalsResponsibleRepository */
    private $somApprovalsResponsibleRepository;

    public function __construct(SomApprovalsResponsibleRepository $somApprovalsResponsibleRepo)
    {
        $this->somApprovalsResponsibleRepository = $somApprovalsResponsibleRepo;
    }

    /**
     * Display a listing of the SomApprovalsResponsible.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somApprovalsResponsibles = $this->somApprovalsResponsibleRepository->all();

        return view('som_approvals_responsibles.index')
            ->with('somApprovalsResponsibles', $somApprovalsResponsibles);
    }

    /**
     * Show the form for creating a new SomApprovalsResponsible.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_approvals_responsibles.create');
    }

    /**
     * Store a newly created SomApprovalsResponsible in storage.
     *
     * @param CreateSomApprovalsResponsibleRequest $request
     *
     * @return Response
     */
    public function store(CreateSomApprovalsResponsibleRequest $request)
    {
        $input = $request->all();

        $somApprovalsResponsible = $this->somApprovalsResponsibleRepository->create($input);

        Flash::success('Som Approvals Responsible saved successfully.');

        return redirect(route('somApprovalsResponsibles.index'));
    }

    /**
     * Display the specified SomApprovalsResponsible.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somApprovalsResponsible = $this->somApprovalsResponsibleRepository->find($id);

        if (empty($somApprovalsResponsible)) {
            Flash::error('Som Approvals Responsible not found');

            return redirect(route('somApprovalsResponsibles.index'));
        }

        return view('som_approvals_responsibles.show')->with('somApprovalsResponsible', $somApprovalsResponsible);
    }

    /**
     * Show the form for editing the specified SomApprovalsResponsible.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somApprovalsResponsible = $this->somApprovalsResponsibleRepository->find($id);

        if (empty($somApprovalsResponsible)) {
            Flash::error('Som Approvals Responsible not found');

            return redirect(route('somApprovalsResponsibles.index'));
        }

        return view('som_approvals_responsibles.edit')->with('somApprovalsResponsible', $somApprovalsResponsible);
    }

    /**
     * Update the specified SomApprovalsResponsible in storage.
     *
     * @param int $id
     * @param UpdateSomApprovalsResponsibleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomApprovalsResponsibleRequest $request)
    {
        $somApprovalsResponsible = $this->somApprovalsResponsibleRepository->find($id);

        if (empty($somApprovalsResponsible)) {
            Flash::error('Som Approvals Responsible not found');

            return redirect(route('somApprovalsResponsibles.index'));
        }

        $somApprovalsResponsible = $this->somApprovalsResponsibleRepository->update($request->all(), $id);

        Flash::success('Som Approvals Responsible updated successfully.');

        return redirect(route('somApprovalsResponsibles.index'));
    }

    /**
     * Remove the specified SomApprovalsResponsible from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somApprovalsResponsible = $this->somApprovalsResponsibleRepository->find($id);

        if (empty($somApprovalsResponsible)) {
            Flash::error('Som Approvals Responsible not found');

            return redirect(route('somApprovalsResponsibles.index'));
        }

        $this->somApprovalsResponsibleRepository->delete($id);

        Flash::success('Som Approvals Responsible deleted successfully.');

        return redirect(route('somApprovalsResponsibles.index'));
    }
}
