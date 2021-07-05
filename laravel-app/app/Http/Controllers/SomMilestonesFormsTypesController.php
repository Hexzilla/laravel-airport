<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomMilestonesFormsTypesRequest;
use App\Http\Requests\UpdateSomMilestonesFormsTypesRequest;
use App\Repositories\SomMilestonesFormsTypesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomMilestonesFormsTypesController extends AppBaseController
{
    /** @var  SomMilestonesFormsTypesRepository */
    private $somMilestonesFormsTypesRepository;

    public function __construct(SomMilestonesFormsTypesRepository $somMilestonesFormsTypesRepo)
    {
        $this->somMilestonesFormsTypesRepository = $somMilestonesFormsTypesRepo;
    }

    /**
     * Display a listing of the SomMilestonesFormsTypes.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somMilestonesFormsTypes = $this->somMilestonesFormsTypesRepository->all();

        return view('som_milestones_forms_types.index')
            ->with('somMilestonesFormsTypes', $somMilestonesFormsTypes);
    }

    /**
     * Show the form for creating a new SomMilestonesFormsTypes.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_milestones_forms_types.create');
    }

    /**
     * Store a newly created SomMilestonesFormsTypes in storage.
     *
     * @param CreateSomMilestonesFormsTypesRequest $request
     *
     * @return Response
     */
    public function store(CreateSomMilestonesFormsTypesRequest $request)
    {
        $input = $request->all();

        $somMilestonesFormsTypes = $this->somMilestonesFormsTypesRepository->create($input);

        Flash::success('Som Milestones Forms Types saved successfully.');

        return redirect(route('somMilestonesFormsTypes.index'));
    }

    /**
     * Display the specified SomMilestonesFormsTypes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somMilestonesFormsTypes = $this->somMilestonesFormsTypesRepository->find($id);

        if (empty($somMilestonesFormsTypes)) {
            Flash::error('Som Milestones Forms Types not found');

            return redirect(route('somMilestonesFormsTypes.index'));
        }

        return view('som_milestones_forms_types.show')->with('somMilestonesFormsTypes', $somMilestonesFormsTypes);
    }

    /**
     * Show the form for editing the specified SomMilestonesFormsTypes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somMilestonesFormsTypes = $this->somMilestonesFormsTypesRepository->find($id);

        if (empty($somMilestonesFormsTypes)) {
            Flash::error('Som Milestones Forms Types not found');

            return redirect(route('somMilestonesFormsTypes.index'));
        }

        return view('som_milestones_forms_types.edit')->with('somMilestonesFormsTypes', $somMilestonesFormsTypes);
    }

    /**
     * Update the specified SomMilestonesFormsTypes in storage.
     *
     * @param int $id
     * @param UpdateSomMilestonesFormsTypesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomMilestonesFormsTypesRequest $request)
    {
        $somMilestonesFormsTypes = $this->somMilestonesFormsTypesRepository->find($id);

        if (empty($somMilestonesFormsTypes)) {
            Flash::error('Som Milestones Forms Types not found');

            return redirect(route('somMilestonesFormsTypes.index'));
        }

        $somMilestonesFormsTypes = $this->somMilestonesFormsTypesRepository->update($request->all(), $id);

        Flash::success('Som Milestones Forms Types updated successfully.');

        return redirect(route('somMilestonesFormsTypes.index'));
    }

    /**
     * Remove the specified SomMilestonesFormsTypes from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somMilestonesFormsTypes = $this->somMilestonesFormsTypesRepository->find($id);

        if (empty($somMilestonesFormsTypes)) {
            Flash::error('Som Milestones Forms Types not found');

            return redirect(route('somMilestonesFormsTypes.index'));
        }

        $this->somMilestonesFormsTypesRepository->delete($id);

        Flash::success('Som Milestones Forms Types deleted successfully.');

        return redirect(route('somMilestonesFormsTypes.index'));
    }
}
