<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsPhasesRequest;
use App\Http\Requests\UpdateSomProjectsPhasesRequest;
use App\Repositories\SomProjectsPhasesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectsPhasesController extends AppBaseController
{
    /** @var  SomProjectsPhasesRepository */
    private $somProjectsPhasesRepository;

    public function __construct(SomProjectsPhasesRepository $somProjectsPhasesRepo)
    {
        $this->somProjectsPhasesRepository = $somProjectsPhasesRepo;
    }

    /**
     * Display a listing of the SomProjectsPhases.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //JOIN BY PROJECT_ID---
        $projectId = $request->input('project_id');
        $somProjectsPhases = $this->somProjectsPhasesRepository->all(['som_projects_id' => $projectId]);
        //---------------------

        return view('som_projects_phases.index')
            ->with('somProjectsPhases', $somProjectsPhases);
    }

    /**
     * Show the form for creating a new SomProjectsPhases.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_projects_phases.create');
    }

    /**
     * Store a newly created SomProjectsPhases in storage.
     *
     * @param CreateSomProjectsPhasesRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsPhasesRequest $request)
    {
        $input = $request->all();

        $somProjectsPhases = $this->somProjectsPhasesRepository->create($input);

        Flash::success('Som Projects Phases saved successfully.');

        return redirect(route('somProjectsPhases.index'));
    }

    /**
     * Display the specified SomProjectsPhases.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectsPhases = $this->somProjectsPhasesRepository->find($id);

        if (empty($somProjectsPhases)) {
            Flash::error('Som Projects Phases not found');

            return redirect(route('somProjectsPhases.index'));
        }

        return view('som_projects_phases.show')->with('somProjectsPhases', $somProjectsPhases);
    }

    /**
     * Show the form for editing the specified SomProjectsPhases.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectsPhases = $this->somProjectsPhasesRepository->find($id);

        if (empty($somProjectsPhases)) {
            Flash::error('Som Projects Phases not found');

            return redirect(route('somProjectsPhases.index'));
        }

        return view('som_projects_phases.edit')->with('somProjectsPhases', $somProjectsPhases);
    }

    /**
     * Update the specified SomProjectsPhases in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsPhasesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsPhasesRequest $request)
    {
        $somProjectsPhases = $this->somProjectsPhasesRepository->find($id);

        if (empty($somProjectsPhases)) {
            Flash::error('Som Projects Phases not found');

            return redirect(route('somProjectsPhases.index'));
        }

        $somProjectsPhases = $this->somProjectsPhasesRepository->update($request->all(), $id);

        Flash::success('Som Projects Phases updated successfully.');

        return redirect(route('somProjectsPhases.index'));
    }

    /**
     * Remove the specified SomProjectsPhases from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsPhases = $this->somProjectsPhasesRepository->find($id);

        if (empty($somProjectsPhases)) {
            Flash::error('Som Projects Phases not found');

            return redirect(route('somProjectsPhases.index'));
        }

        $this->somProjectsPhasesRepository->delete($id);

        Flash::success('Som Projects Phases deleted successfully.');

        return redirect(route('somProjectsPhases.index'));
    }
}