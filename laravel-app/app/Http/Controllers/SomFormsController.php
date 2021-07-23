<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomFormsRequest;
use App\Http\Requests\UpdateSomFormsRequest;
use App\Repositories\SomFormsRepository;
use App\Repositories\SomProjectsMilestonesRepository;
use App\Models\SomForms;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

class SomFormsController extends AppBaseController
{
    /** @var  SomFormsRepository */
    private $somFormsRepository;
    private $somProjectsMilestonesRepository;

    public function __construct(SomFormsRepository $somFormsRepo,
                                SomProjectsMilestonesRepository $somProjectsMilestonesRepo)
    {
        $this->somFormsRepository = $somFormsRepo;
        $this->somProjectsMilestonesRepository = $somProjectsMilestonesRepo;
    }

    /**
     * Display a listing of the SomForms.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $milestones_id = $request->get('milestones_id');
            
        $breadcrumbs = array();
        $breadcrumbs[0] = array();         
        $breadcrumbs[0]['id'] = 0;
        $breadcrumbs[0]['name'] = "";
        $breadcrumbs[1] = array();
        $breadcrumbs[1]['id'] = 0;
        $breadcrumbs[1]['name'] = "";
        $breadcrumbs[2] = array();
        $breadcrumbs[2]['id'] = 0;
        $breadcrumbs[2]['name'] = "";

        if(!empty($milestones_id)){
            $bradeAry = $this->somProjectsMilestonesRepository->getbreadcrumbsById($milestones_id);          
               
            //projects        
            $breadcrumbs[0]['id'] = $bradeAry[0]['som_projects_id'];            
            $breadcrumbs[0]['name'] = $bradeAry[0]['som_projects_name'];
            //phases            
            $breadcrumbs[1]['id'] = $bradeAry[0]['som_projects_phases_id'];
            $breadcrumbs[1]['name'] = $bradeAry[0]['som_phases_name'];
            //milestones 
            $breadcrumbs[2]['id'] = $milestones_id;
            $breadcrumbs[2]['name'] = $bradeAry[0]['name']; 
        }

        if ($request->ajax()) {

            if( !empty($milestones_id) ){
                $data = $this->somFormsRepository->all(['som_phases_milestones_id'=>$milestones_id]);
            }
            else{
                $data = $this->somFormsRepository->all();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('is_inactive', function ($request) {
                    $html = "";
                    if(!empty($request->is_inactive)){
                        $html = $request->is_inactive;
                    }
                    return $html; 
                })
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button tasks
                    $action .= "<a href=\"".route('somFormTasks.index', ['somforms_id'=>$row->id])."\" class='btn btn-default btn-xs'>
                        <i class='far fa-task'></i>tasks</a>";

                    //button elements
                    $action .= "<a href=\"".route('somFormElements.index', ['somforms_id'=>$row->id])."\" class='btn btn-default btn-xs'>
                        <i class='far fa-task'></i>elements</a>";

                    //button approvals
                    $action .= "<a href=\"".route('somFormApprovals.index', ['somforms_id'=>$row->id])."\" class='btn btn-default btn-xs'>
                        <i class='far fa-task'></i>approvals</a>";

                    //button show                
                    $action .= "<a href=\"".route('somForms.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somForms.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_forms.index')
                ->with('milestones_id', $milestones_id)
                ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomForms.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

        $somForm = new SomForms(); 
        $milestones_id = $request->get('milestones_id');
        $somForm->active = 1;
        $somForm->order_form = 1;
        $somForm->som_milestones_forms_types_id = 1;
        $somForm->som_phases_milestones_id = $milestones_id;
        return view('som_forms.create')
                ->with('milestones_id', $milestones_id)
                ->with('somForms', $somForm);
    }

    /**
     * Store a newly created SomForms in storage.
     *
     * @param CreateSomFormsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomFormsRequest $request)
    {
        $milestones_id = $request->get('som_phases_milestones_id');

        try{
            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $input = $request->all();

            $somForms = $this->somFormsRepository->create($input);
        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomFormsController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somForms.index',['milestones_id'=> $milestones_id]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Forms saved successfully.');
        
        return redirect(route('somForms.index',['milestones_id'=> $milestones_id]));
    }

    /**
     * Display the specified SomForms.
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

        $somForms = $this->somFormsRepository->find($id);

        if (empty($somForms)) {
            Flash::error('Som Forms not found');

            return redirect(route('somForms.index'));
        }
        $milestones_id = $somForms->som_phases_milestones_id;
        return view('som_forms.show')
                ->with('milestones_id', $milestones_id)
                ->with('somForms', $somForms);
    }

    /**
     * Show the form for editing the specified SomForms.
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

        $somForms = $this->somFormsRepository->find($id);

        if (empty($somForms)) {
            Flash::error('Som Forms not found');

            return redirect(route('somForms.index'));
        }
        $milestones_id =  $somForms->som_phases_milestones_id;
        return view('som_forms.edit')
                ->with('milestones_id', $milestones_id )
                ->with('somForms', $somForms);
    }

    /**
     * Update the specified SomForms in storage.
     *
     * @param int $id
     * @param UpdateSomFormsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomFormsRequest $request)
    {
        $milestones_id = $request->get('som_phases_milestones_id');
        try{

            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somForms = $this->somFormsRepository->find($id);

            if (empty($somForms)) {
                Flash::error('Som Forms not found');

                return redirect(route('somForms.index'));
            }

            $somForms = $this->somFormsRepository->update($request->all(), $id);

        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomFormsController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somForms.index', ['milestones_id'=>$milestones_id ]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Forms updated successfully.');

        return redirect(route('somForms.index', ['milestones_id'=>$milestones_id ]));
    }

    /**
     * Remove the specified SomForms from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $milestones_id = 0;

        try{

            if(!CRUDBooster::isDelete()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_delete",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somForms = $this->somFormsRepository->find($id);

            if (empty($somForms)) {
                Flash::error('Som Forms not found');

                return redirect(route('somForms.index'));
            }
            $milestones_id =  $somForms->som_phases_milestones_id;
            $this->somFormsRepository->delete($id);
            
        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomFormsController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somForms.index', ['milestones_id'=>$milestones_id]));
        }
        
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Forms deleted successfully.');
        
        return redirect(route('somForms.index', ['milestones_id'=>$milestones_id]));
    }
}
