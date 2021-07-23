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
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

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
        }else{
            if (!CRUDBooster::isView()) {
              CRUDBooster::insertLog(trans("crudbooster.log_try_view",['module'=>CRUDBooster::getCurrentModule()->name]));
              CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
            }
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
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

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
        $project_id = $request->input('som_projects_id');

        try{
            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }        

            $somProjectsPhases = $this->somProjectsPhasesRepository->create($input);
            $project_id = $somProjectsPhases->som_projects_id;
        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomProjectsPhasesController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsPhases.index', ['project_id'=>$project_id]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects Phases saved successfully.');
        
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
        if (!CRUDBooster::isRead()) {
            CRUDBooster::insertLog(trans("crudbooster.log_try_view", ['module'=>CRUDBooster::getCurrentModule()->name]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

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
        if (!CRUDBooster::isRead()) {
            CRUDBooster::insertLog(trans("crudbooster.log_try_edit", ['module'=>CRUDBooster::getCurrentModule()->name]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

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
        $project_id = 0;

        try{
            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somProjectsPhases = $this->somProjectsPhasesRepository->find($id);

            if (empty($somProjectsPhases)) {
                Flash::error('Som Projects Phases not found');

                return redirect(route('somProjectsPhases.index'));
            }
            $project_id = $somProjectsPhases->som_projects_id;

            $somProjectsPhases = $this->somProjectsPhasesRepository->update($request->all(), $id);
        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomProjectsPhasesController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsPhases.index', ['project_id'=>$project_id]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));
        
        Flash::success('Som Projects Phases updated successfully.');
        
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
        $project_id = 0;

        try{
            if(!CRUDBooster::isDelete()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_delete",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

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
        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomProjectsPhasesController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsPhases.index', ['project_id'=>$project_id]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects Phases deleted successfully.');

        return redirect(route('somProjectsPhases.index', ['project_id'=>$project_id]));
    }
}