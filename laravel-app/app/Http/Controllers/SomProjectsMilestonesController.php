<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsMilestonesRequest;
use App\Http\Requests\UpdateSomProjectsMilestonesRequest;
use App\Repositories\SomProjectsMilestonesRepository;
use App\Repositories\SomProjectsPhasesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

class SomProjectsMilestonesController extends AppBaseController
{
    /** @var  SomProjectsMilestonesRepository */
    private $somProjectsMilestonesRepository;
    private $somProjectsPhasesRepository;

    public function __construct(SomProjectsMilestonesRepository $somProjectsMilestonesRepo,
                                SomProjectsPhasesRepository $somProjectsPhasesRepo)
    {
        $this->somProjectsMilestonesRepository = $somProjectsMilestonesRepo;
        $this->somProjectsPhasesRepository = $somProjectsPhasesRepo;
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
        // if(!empty($phases_id))
        //     $somProjectsMilestones = $this->somProjectsMilestonesRepository->all(['som_projects_phases_id'=>$phases_id]);
        // else
        //     $somProjectsMilestones = $this->somProjectsMilestonesRepository->all();

        $breadcrumbs = array();
        $breadcrumbs[0] = array();         
        $breadcrumbs[0]['id'] = 0;
        $breadcrumbs[0]['name'] = "";
        $breadcrumbs[1] = array();
        $breadcrumbs[1]['id'] = 0;
        $breadcrumbs[1]['name'] = "";

        if(!empty($phases_id)){
            $bradeAry = $this->somProjectsPhasesRepository->getbreadcrumbsById($phases_id);          
                      
            $breadcrumbs[0]['id'] = $bradeAry[0]['som_projects_id'];
            $breadcrumbs[0]['name'] = $bradeAry[0]['som_projects_name'];            
            $breadcrumbs[1]['id'] = $phases_id;
            $breadcrumbs[1]['name'] = $bradeAry[0]['som_phases_name'];
        }

        if ($request->ajax()) {

            if(!empty($phases_id))
                $data = $this->somProjectsMilestonesRepository->all(['som_projects_phases_id'=>$phases_id]);
            else
                $data = $this->somProjectsMilestonesRepository->all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('due_date', function ($request) {
                    $due_date = "";
                    if(!empty($request->due_date)){
                        $due_date = date('Y-m-d', strtotime($request->due_date));
                    }
                    return $due_date; 
                })
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button Forms                    
                    $action .= "<a href=\"".route( "somForms.index", ['milestones_id'=> $row->id] )."\" class='btn btn-default btn-xs'><i class='fas fa-list' title='Forms'></i> Forms</a>";

                    //button show                
                    $action .= "<a href=\"".route('somProjectsMilestones.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somProjectsMilestones.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_projects_milestones.index')
                ->with('somProjectsPhaseId', $phases_id)
                ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomProjectsMilestones.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

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
        $phases_id = $request->get('som_projects_phases_id');

        try{

            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $input = $request->all();

            $somProjectsMilestones = $this->somProjectsMilestonesRepository->create($input);

        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomProjectsMilestonesController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsMilestones.index', ['phases_id'=>$phases_id]));
        } 
            
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects Milestones saved successfully.');

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
        if (!CRUDBooster::isRead()) {
            CRUDBooster::insertLog(trans("crudbooster.log_try_view", ['module'=>CRUDBooster::getCurrentModule()->name]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

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
        if (!CRUDBooster::isRead()) {
            CRUDBooster::insertLog(trans("crudbooster.log_try_edit", ['module'=>CRUDBooster::getCurrentModule()->name]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

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
        $phases_id = $request->get('som_projects_phases_id');

        try{

            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somProjectsMilestones = $this->somProjectsMilestonesRepository->find($id);

            if (empty($somProjectsMilestones)) {
                Flash::error('Som Projects Milestones not found');

                return redirect(route('somProjectsMilestones.index', ['phases_id'=>$phases_id]));
            }

            $somProjectsMilestones = $this->somProjectsMilestonesRepository->update($request->all(), $id);

        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomProjectsMilestonesController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsMilestones.index', ['phases_id'=>$phases_id]));
        } 
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects Milestones updated successfully.');

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
        $phases_id = 0;

        try{
            if(!CRUDBooster::isDelete()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_delete",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }
            $somProjectsMilestones = $this->somProjectsMilestonesRepository->find($id);

            if (empty($somProjectsMilestones)) {
                Flash::error('Som Projects Milestones not found');

                return redirect(route('somProjectsMilestones.index'));
            }
            $phases_id = $somProjectsMilestones->som_projects_phases_id;

            $this->somProjectsMilestonesRepository->delete($id);
        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomProjectsMilestonesController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsMilestones.index', ['phases_id'=>$phases_id]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects Milestones deleted successfully.');
        
        return redirect(route('somProjectsMilestones.index', ['phases_id'=>$phases_id]));
    }
}
