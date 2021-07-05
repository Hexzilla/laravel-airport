<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomPhasesMilestonesTypesRequest;
use App\Http\Requests\UpdateSomPhasesMilestonesTypesRequest;
use App\Repositories\SomPhasesMilestonesTypesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomPhasesMilestonesTypesController extends AppBaseController
{
    /** @var  SomPhasesMilestonesTypesRepository */
    private $somPhasesMilestonesTypesRepository;

    public function __construct(SomPhasesMilestonesTypesRepository $somPhasesMilestonesTypesRepo)
    {
        $this->somPhasesMilestonesTypesRepository = $somPhasesMilestonesTypesRepo;
    }

    /**
     * Display a listing of the SomPhasesMilestonesTypes.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somPhasesMilestonesTypes = $this->somPhasesMilestonesTypesRepository->all();

        return view('som_phases_milestones_types.index')
            ->with('somPhasesMilestonesTypes', $somPhasesMilestonesTypes);
    }

    /**
     * Show the form for creating a new SomPhasesMilestonesTypes.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_phases_milestones_types.create');
    }

    /**
     * Store a newly created SomPhasesMilestonesTypes in storage.
     *
     * @param CreateSomPhasesMilestonesTypesRequest $request
     *
     * @return Response
     */
    public function store(CreateSomPhasesMilestonesTypesRequest $request)
    {
        $input = $request->all();

        $somPhasesMilestonesTypes = $this->somPhasesMilestonesTypesRepository->create($input);

        Flash::success('Som Phases Milestones Types saved successfully.');

        return redirect(route('somPhasesMilestonesTypes.index'));
    }

    /**
     * Display the specified SomPhasesMilestonesTypes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somPhasesMilestonesTypes = $this->somPhasesMilestonesTypesRepository->find($id);

        if (empty($somPhasesMilestonesTypes)) {
            Flash::error('Som Phases Milestones Types not found');

            return redirect(route('somPhasesMilestonesTypes.index'));
        }

        return view('som_phases_milestones_types.show')->with('somPhasesMilestonesTypes', $somPhasesMilestonesTypes);
    }

    /**
     * Show the form for editing the specified SomPhasesMilestonesTypes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somPhasesMilestonesTypes = $this->somPhasesMilestonesTypesRepository->find($id);

        if (empty($somPhasesMilestonesTypes)) {
            Flash::error('Som Phases Milestones Types not found');

            return redirect(route('somPhasesMilestonesTypes.index'));
        }

        return view('som_phases_milestones_types.edit')->with('somPhasesMilestonesTypes', $somPhasesMilestonesTypes);
    }

    /**
     * Update the specified SomPhasesMilestonesTypes in storage.
     *
     * @param int $id
     * @param UpdateSomPhasesMilestonesTypesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomPhasesMilestonesTypesRequest $request)
    {
        $somPhasesMilestonesTypes = $this->somPhasesMilestonesTypesRepository->find($id);

        if (empty($somPhasesMilestonesTypes)) {
            Flash::error('Som Phases Milestones Types not found');

            return redirect(route('somPhasesMilestonesTypes.index'));
        }

        $somPhasesMilestonesTypes = $this->somPhasesMilestonesTypesRepository->update($request->all(), $id);

        Flash::success('Som Phases Milestones Types updated successfully.');

        return redirect(route('somPhasesMilestonesTypes.index'));
    }

    /**
     * Remove the specified SomPhasesMilestonesTypes from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somPhasesMilestonesTypes = $this->somPhasesMilestonesTypesRepository->find($id);

        if (empty($somPhasesMilestonesTypes)) {
            Flash::error('Som Phases Milestones Types not found');

            return redirect(route('somPhasesMilestonesTypes.index'));
        }

        $this->somPhasesMilestonesTypesRepository->delete($id);

        Flash::success('Som Phases Milestones Types deleted successfully.');

        return redirect(route('somPhasesMilestonesTypes.index'));
    }
}
