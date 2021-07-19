<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsPhasesRequest;
use App\Http\Requests\UpdateSomProjectsPhasesRequest;
use App\Repositories\SomProjectsPhasesRepository;
use App\Repositories\SomStatusRepository;
use App\Repositories\SomPhasesRepository;
use App\Repositories\SomProjectsMilestonesRepository;
use App\Repositories\SomProjectsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;

class SomProjectsPhasesController extends AppBaseController
{
    /** @var  SomProjectsPhasesRepository */
    private $somProjectsPhasesRepository;
    private $somPhasesStatusRepository;
    private $somPhasesRepository;
    private $somProjectsMilestonesRepository;
    private $somProjectsRepository;

    public function __construct(
                SomProjectsPhasesRepository $somProjectsPhasesRepo,
                SomStatusRepository $somPhasesStatusRepo,
                SomPhasesRepository $somPhasesRepo,
                SomProjectsMilestonesRepository $somProjectsMilestonesRepo,
                SomProjectsRepository $somProjectsRepo
                )
    {
        $this->somProjectsPhasesRepository = $somProjectsPhasesRepo;
        $this->somPhasesStatusRepository = $somPhasesStatusRepo;
        $this->somPhasesRepository = $somPhasesRepo;
        $this->somProjectsMilestonesRepository = $somProjectsMilestonesRepo;
        $this->somProjectsRepository = $somProjectsRepo;
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
        // $somProjectsPhases = $this->somProjectsPhasesRepository->all(['som_projects_id' => $projectId]);

        $somProjects = $this->somProjectsRepository->find($projectId);
        $breadcrumbs = array();
        $breadcrumbs[0] = array();
        $breadcrumbs[0]['id'] = $somProjects['id'];
        $breadcrumbs[0]['name'] = $somProjects['name'];
        //---------------------
        if ($request->ajax()) {

            $data = $this->somProjectsPhasesRepository->getDataBySomProjectsId($projectId);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button Milestones
                    $action .= "<a href=\"".route("somProjectsMilestones.index",
                        ['phases_id'=> $row->id]
                    )."\" class='btn btn-default btn-xs'><i class='fas fa-film' title='Milestones'></i> Milestones</a>";

                    //button show
                    // $action .= "<a href=\"".route('somProjectsPhases.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    // $action .= "<i class='far fa-eye'></i>";
                    // $action .= "</a>";

                    //button edit
                    $action .= "<a href=\"".route('somProjectsPhases.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-edit'></i>";

                    //button delete
                    $action .= "</a>";
                    $action .= "<button class='btn btn-danger btn-xs' onclick='openDeleteModal(\"".$row->id."\")'><i class='far fa-trash-alt'></i></button>";

                    $action .= "</div>";
                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('som_projects_phases.index')
                ->with('projectId', $projectId)
                ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomProjectsPhases.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $projectId = $request->input('project_id');

        $somProjectsPhaseStatus = $this->somPhasesStatusRepository->all(['type'=>'phases'], null, null, ['id', 'name', 'hex_color'] )->toArray();
        $status = array(0 => '**Please Select a Status');
        foreach($somProjectsPhaseStatus as $rows)
        {
            $status[$rows['id']] = $rows['name'];   //'hex_color' => $row['hex_color']
        }


        $somProjectsPhasesArray = $this->somPhasesRepository->all([], null, null, ['id', 'name', 'hex_color'])->toArray();
        $phases = array(0 => '**Please Select a phase');
        foreach($somProjectsPhasesArray as $rows)
        {
            $phases[$rows['id']] = $rows['name'];   //'hex_color' => $row['hex_color']
        }


        return view('som_projects_phases.create')
                    ->with('som_projects_phases_id', 0)
                    ->with('somPhaseArray', $phases)
                    ->with('somStatusArray', $status)
                    ->with('selectedPhaseItem', 0)
                    ->with('projectId', $projectId);
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

        $project_id = $somProjectsPhases->som_projects_id;
        return redirect(route('somProjectsPhases.index', ['project_id'=>$project_id]));
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


        $somProjectsPhaseStatus = $this->somPhasesStatusRepository->all(['type'=>'phases'], null, null, ['id', 'name', 'hex_color'] )->toArray();
        $status = array(0 => '**Please Select a Status');
        foreach($somProjectsPhaseStatus as $rows)
        {
            $status[$rows['id']] = $rows['name'];   //'hex_color' => $row['hex_color']
        }


        $somProjectsPhasesArray = $this->somPhasesRepository->all([], null, null, ['id', 'name', 'hex_color'])->toArray();
        $phases = array(0 => '**Please Select a phase');
        foreach($somProjectsPhasesArray as $rows)
        {
            $phases[$rows['id']] = $rows['name'];   //'hex_color' => $row['hex_color']
        }


        $projectId = $somProjectsPhases->som_projects_id;
        return view('som_projects_phases.edit')
                ->with('som_projects_phases_id', $id)
                ->with('projectId', $projectId)
                ->with('somPhaseArray', $phases)
                ->with('somStatusArray', $status)
                ->with('selectedPhaseItem', $somProjectsPhases->toArray())
                ->with('somProjectsPhases', $somProjectsPhases);
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
        $project_id = $somProjectsPhases->som_projects_id;
        return redirect(route('somProjectsPhases.index', ['project_id'=>$project_id]));
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
        $project_id = $somProjectsPhases->som_projects_id;
        $milestones = $this->somProjectsMilestonesRepository->all(['som_projects_phases_id'=>$id])->toArray();
        if(count($milestones)>0)
        {
            Flash::error('First some milestones must be deleted for the Phases');
            return redirect(route('somProjectsPhases.index', ['project_id'=>$project_id]));
        }

        $this->somProjectsPhasesRepository->delete($id);

        Flash::success('Som Projects Phases deleted successfully.');

        return redirect(route('somProjectsPhases.index', ['project_id'=>$project_id]));
    }
}
