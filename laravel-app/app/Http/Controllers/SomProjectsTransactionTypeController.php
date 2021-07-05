<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsTransactionTypeRequest;
use App\Http\Requests\UpdateSomProjectsTransactionTypeRequest;
use App\Repositories\SomProjectsTransactionTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectsTransactionTypeController extends AppBaseController
{
    /** @var  SomProjectsTransactionTypeRepository */
    private $somProjectsTransactionTypeRepository;

    public function __construct(SomProjectsTransactionTypeRepository $somProjectsTransactionTypeRepo)
    {
        $this->somProjectsTransactionTypeRepository = $somProjectsTransactionTypeRepo;
    }

    /**
     * Display a listing of the SomProjectsTransactionType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somProjectsTransactionTypes = $this->somProjectsTransactionTypeRepository->all();

        return view('som_projects_transaction_types.index')
            ->with('somProjectsTransactionTypes', $somProjectsTransactionTypes);
    }

    /**
     * Show the form for creating a new SomProjectsTransactionType.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_projects_transaction_types.create');
    }

    /**
     * Store a newly created SomProjectsTransactionType in storage.
     *
     * @param CreateSomProjectsTransactionTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsTransactionTypeRequest $request)
    {
        $input = $request->all();

        $somProjectsTransactionType = $this->somProjectsTransactionTypeRepository->create($input);

        Flash::success('Som Projects Transaction Type saved successfully.');

        return redirect(route('somProjectsTransactionTypes.index'));
    }

    /**
     * Display the specified SomProjectsTransactionType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectsTransactionType = $this->somProjectsTransactionTypeRepository->find($id);

        if (empty($somProjectsTransactionType)) {
            Flash::error('Som Projects Transaction Type not found');

            return redirect(route('somProjectsTransactionTypes.index'));
        }

        return view('som_projects_transaction_types.show')->with('somProjectsTransactionType', $somProjectsTransactionType);
    }

    /**
     * Show the form for editing the specified SomProjectsTransactionType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectsTransactionType = $this->somProjectsTransactionTypeRepository->find($id);

        if (empty($somProjectsTransactionType)) {
            Flash::error('Som Projects Transaction Type not found');

            return redirect(route('somProjectsTransactionTypes.index'));
        }

        return view('som_projects_transaction_types.edit')->with('somProjectsTransactionType', $somProjectsTransactionType);
    }

    /**
     * Update the specified SomProjectsTransactionType in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsTransactionTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsTransactionTypeRequest $request)
    {
        $somProjectsTransactionType = $this->somProjectsTransactionTypeRepository->find($id);

        if (empty($somProjectsTransactionType)) {
            Flash::error('Som Projects Transaction Type not found');

            return redirect(route('somProjectsTransactionTypes.index'));
        }

        $somProjectsTransactionType = $this->somProjectsTransactionTypeRepository->update($request->all(), $id);

        Flash::success('Som Projects Transaction Type updated successfully.');

        return redirect(route('somProjectsTransactionTypes.index'));
    }

    /**
     * Remove the specified SomProjectsTransactionType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsTransactionType = $this->somProjectsTransactionTypeRepository->find($id);

        if (empty($somProjectsTransactionType)) {
            Flash::error('Som Projects Transaction Type not found');

            return redirect(route('somProjectsTransactionTypes.index'));
        }

        $this->somProjectsTransactionTypeRepository->delete($id);

        Flash::success('Som Projects Transaction Type deleted successfully.');

        return redirect(route('somProjectsTransactionTypes.index'));
    }
}
