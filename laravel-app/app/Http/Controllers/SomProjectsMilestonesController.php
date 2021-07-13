<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsMilestonesRequest;
use App\Http\Requests\UpdateSomProjectsMilestonesRequest;
use App\Repositories\SomProjectsMilestonesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectsMilestonesController extends AppBaseController
{
    /** @var  SomProjectsMilestonesRepository */
    private $somProjectsMilestonesRepository;

    public function __construct(SomProjectsMilestonesRepository $somProjectsMilestonesRepo)
    {
        $this->somProjectsMilestonesRepository = $somProjectsMilestonesRepo;
    }

    /**
     * Display a listing of the SomProjectsMilestones.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $phases_id = $request->get('phases_id');
        if(!empty($phases_id))
            $somProjectsMilestones = $this->somProjectsMilestonesRepository->all(['som_projects_phases_id'=>$phases_id]);
        else
            $somProjectsMilestones = $this->somProjectsMilestonesRepository->all();

        return view('som_projects_milestones.index')
                ->with('somProjectsPhaseId', $phases_id)
                ->with('somProjectsMilestones', $somProjectsMilestones);
    }

    /**
     * Show the form for creating a new SomProjectsMilestones.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $phases_id = $request->get('phases_id');
        return view('som_projects_milestones.create')
                ->with('somProjectsMilestones', array())
                ->with('somProjectsPhaseId', $phases_id);
    }

    /**
     * Store a newly created SomProjectsMilestones in storage.
     *
     * @param CreateSomProjectsMilestonesRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsMilestonesRequest $request)
    {
        $input = $request->all();

        $somProjectsMilestones = $this->somProjectsMilestonesRepository->create($input);

        Flash::success('Som Projects Milestones saved successfully.');

        $phases_id = $somProjectsMilestones->som_projects_phases_id;
        return redirect(route('somProjectsMilestones.index', ['phases_id'=>$phases_id]));
    }

    /**
     * Display the specified SomProjectsMilestones.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectsMilestones = $this->somProjectsMilestonesRepository->find($id);

        if (empty($somProjectsMilestones)) {
            Flash::error('Som Projects Milestones not found');

            return redirect(route('somProjectsMilestones.index'));
        }

        return view('som_projects_milestones.show')->with('somProjectsMilestones', $somProjectsMilestones);
    }

    /**
     * Show the form for editing the specified SomProjectsMilestones.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectsMilestones = $this->somProjectsMilestonesRepository->find($id);

        if (empty($somProjectsMilestones)) {
            Flash::error('Som Projects Milestones not found');

            return redirect(route('somProjectsMilestones.index'));
        }
        $phases_id = $somProjectsMilestones->som_projects_phases_id;
        return view('som_projects_milestones.edit')
                ->with('somProjectsPhaseId', $phases_id)
                ->with('somProjectsMilestones', $somProjectsMilestones);
    }

    /**
     * Update the specified SomProjectsMilestones in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsMilestonesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsMilestonesRequest $request)
    {
        $somProjectsMilestones = $this->somProjectsMilestonesRepository->find($id);

        if (empty($somProjectsMilestones)) {
            Flash::error('Som Projects Milestones not found');

            return redirect(route('somProjectsMilestones.index'));
        }

        $somProjectsMilestones = $this->somProjectsMilestonesRepository->update($request->all(), $id);

        Flash::success('Som Projects Milestones updated successfully.');

        $phases_id = $somProjectsMilestones->som_projects_phases_id;
        return redirect(route('somProjectsMilestones.index', ['phases_id'=>$phases_id]));
    }

    /**
     * Remove the specified SomProjectsMilestones from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsMilestones = $this->somProjectsMilestonesRepository->find($id);

        if (empty($somProjectsMilestones)) {
            Flash::error('Som Projects Milestones not found');

            return redirect(route('somProjectsMilestones.index'));
        }

        $this->somProjectsMilestonesRepository->delete($id);

        Flash::success('Som Projects Milestones deleted successfully.');

        $phases_id = $somProjectsMilestones->som_projects_phases_id;
        return redirect(route('somProjectsMilestones.index', ['phases_id'=>$phases_id]));
    }
}
