<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomApprovalsResponsibleRequest;
use App\Http\Requests\UpdateSomApprovalsResponsibleRequest;
use App\Repositories\SomApprovalsResponsibleRepository;
use App\Repositories\SomFormApprovalsRepository;
use App\Repositories\CmsPrivilegesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

class SomApprovalsResponsibleController extends AppBaseController
{
    /** @var  SomApprovalsResponsibleRepository */
    private $somApprovalsResponsibleRepository;
    private $somFormApprovalsRepository;
    private $cmsPrivilegesRepository;

    public function __construct(SomApprovalsResponsibleRepository $somApprovalsResponsibleRepo,
                                SomFormApprovalsRepository $somFormApprovalsRepo,
                                CmsPrivilegesRepository $cmsPrivilegesRepository)
    {
        $this->somApprovalsResponsibleRepository = $somApprovalsResponsibleRepo;
        $this->somFormApprovalsRepository = $somFormApprovalsRepo;
        $this->cmsPrivilegesRepository = $cmsPrivilegesRepository;
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
        $som_form_approvals_id = $request->get('som_form_approvals_id');
        /*$somApprovalsResponsibles = $this->somApprovalsResponsibleRepository->all(['som_form_approvals_id'=>$som_form_approvals_id]);*/

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
        $breadcrumbs[3] = array();
        $breadcrumbs[3]['id'] = 0;
        $breadcrumbs[3]['name'] = "";
        $breadcrumbs[4] = array();
        $breadcrumbs[4]['id'] = 0;
        $breadcrumbs[4]['name'] = "";

        if(!empty($som_form_approvals_id)){
            $bradeAry = $this->somFormApprovalsRepository->getbreadcrumbsById($som_form_approvals_id); 

            //projects        
            $breadcrumbs[0]['id'] = $bradeAry[0]['som_projects_id'];            
            $breadcrumbs[0]['name'] = $bradeAry[0]['som_projects_name'];
            //phases            
            $breadcrumbs[1]['id'] = $bradeAry[0]['som_projects_phases_id'];
            $breadcrumbs[1]['name'] = $bradeAry[0]['som_phases_name'];
            //milestones 
            $breadcrumbs[2]['id'] = $bradeAry[0]['som_phases_milestones_id']; 
            $breadcrumbs[2]['name'] = $bradeAry[0]['som_phases_milestones_name']; 
            //forms
            $breadcrumbs[3]['id'] = $bradeAry[0]['som_forms_id'];
            $breadcrumbs[3]['name'] = $bradeAry[0]['som_forms_name'];
            //approvals
            $breadcrumbs[4]['id'] = $som_form_approvals_id; 
            $breadcrumbs[4]['name'] = $bradeAry[0]['name'];

        }

        if ($request->ajax()) {

            // $data = $this->somApprovalsResponsibleRepository->all(['som_form_approvals_id'=>$som_form_approvals_id]);
            $data = $this->somApprovalsResponsibleRepository->getAllData($som_form_approvals_id);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button Assigned Status Options                    
                    $action .= "<a href=\"".route("somStatusApprovals.index",['som_approvals_responsible_id'=> $row->id])."\" class='btn btn-default btn-xs'><i class='fa fa-circle-o'></i> Assigned Status Options</a>";

                    //button show                
                    $action .= "<a href=\"".route('somApprovalsResponsibles.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somApprovalsResponsibles.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_approvals_responsibles.index')
            ->with('som_form_approvals_id', $som_form_approvals_id)
            ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomApprovalsResponsible.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

        $som_form_approvals_id = $request->get("som_form_approvals_id");

        $data = array();

        $data['cmsPrivileges'] = array();
        $cmsPrivileges = $this->cmsPrivilegesRepository->all();
        $cnt = 0;
        $selected_privilege_id = 0;
        foreach ($cmsPrivileges as $cmsPrivilege) {
            $data['cmsPrivileges'][$cmsPrivilege->id] = $cmsPrivilege->name;
            if($cnt == 0){
                $selected_privilege_id = $cmsPrivilege->id;
            }
            $cnt++;
        }  
        $data['selected_privilege_id_assigned'] = $selected_privilege_id;
        $data['selected_privilege_id_notify'] = $selected_privilege_id;

        return view('som_approvals_responsibles.create')
                ->with('som_form_approvals_id',$som_form_approvals_id)
                ->with('data',$data);
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
        $som_form_approvals_id = $request->input('som_form_approvals_id');

        try{

            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $somApprovalsResponsible = $this->somApprovalsResponsibleRepository->create($input);

        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomApprovalsResponsibleController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somApprovalsResponsibles.index',['som_form_approvals_id'=> $som_form_approvals_id]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Approvals Responsible saved successfully.');

        // return redirect(route('somApprovalsResponsibles.index',['som_form_approvals_id'=> $som_form_approvals_id]));
        if(!empty($request->input('sub1'))){ //save
            return redirect(route('somApprovalsResponsibles.index',['som_form_approvals_id'=> $som_form_approvals_id]));
        }else{ //save and more add
            return redirect(route('somApprovalsResponsibles.create',['som_form_approvals_id'=> $som_form_approvals_id]));
        } 
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
        if (!CRUDBooster::isRead()) {
            CRUDBooster::insertLog(trans("crudbooster.log_try_view", ['module'=>CRUDBooster::getCurrentModule()->name]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

        $somApprovalsResponsible = $this->somApprovalsResponsibleRepository->find($id);

        if (empty($somApprovalsResponsible)) {
            Flash::error('Som Approvals Responsible not found');

            return redirect(route('somApprovalsResponsibles.index'));
        }

        $som_form_approvals_id = $somApprovalsResponsible->som_form_approvals_id;

        return view('som_approvals_responsibles.show')
                ->with('som_form_approvals_id', $som_form_approvals_id)
                ->with('somApprovalsResponsible', $somApprovalsResponsible);
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
        if (!CRUDBooster::isRead()) {
            CRUDBooster::insertLog(trans("crudbooster.log_try_edit", ['module'=>CRUDBooster::getCurrentModule()->name]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

        $somApprovalsResponsible = $this->somApprovalsResponsibleRepository->find($id);

        if (empty($somApprovalsResponsible)) {
            Flash::error('Som Approvals Responsible not found');

            return redirect(route('somApprovalsResponsibles.index'));
        }

        $data = array();

        $data['cmsPrivileges'] = array();
        $cmsPrivileges = $this->cmsPrivilegesRepository->all();
        $selected_privilege_id = 0;
        foreach ($cmsPrivileges as $cmsPrivilege) {
            $data['cmsPrivileges'][$cmsPrivilege->id] = $cmsPrivilege->name;
        }  
        $data['selected_privilege_id_assigned'] = $somApprovalsResponsible->cms_privilege_id_assigned;
        $data['selected_privilege_id_notify'] = $somApprovalsResponsible->cms_privilege_id_notify;

        return view('som_approvals_responsibles.edit')
                    ->with('som_form_approvals_id',$somApprovalsResponsible->som_form_approvals_id)
                    ->with('data',$data)
                    ->with('somApprovalsResponsible', $somApprovalsResponsible);
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
        $som_form_approvals_id = $request->input('som_form_approvals_id');

        try{

            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somApprovalsResponsible = $this->somApprovalsResponsibleRepository->find($id);        

            if (empty($somApprovalsResponsible)) {
                Flash::error('Som Approvals Responsible not found');

                return redirect(route('somApprovalsResponsibles.index',['som_form_approvals_id'=> $som_form_approvals_id]));
            }

            $somApprovalsResponsible = $this->somApprovalsResponsibleRepository->update($request->all(), $id);

        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomApprovalsResponsibleController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somApprovalsResponsibles.index',['som_form_approvals_id'=> $som_form_approvals_id]));
        } 
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Approvals Responsible updated successfully.');

        return redirect(route('somApprovalsResponsibles.index',['som_form_approvals_id'=> $som_form_approvals_id]));
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
    public function destroy($id, Request $request)
    {
        $som_form_approvals_id = $request->input('som_form_approvals_id'); 

        try{

            if(!CRUDBooster::isDelete()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_delete",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somApprovalsResponsible = $this->somApprovalsResponsibleRepository->find($id);        

            if (empty($somApprovalsResponsible)) {
                Flash::error('Som Approvals Responsible not found');

                return redirect(route('somApprovalsResponsibles.index',['som_form_approvals_id'=> $som_form_approvals_id]));
            }

            $this->somApprovalsResponsibleRepository->delete($id);

        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomApprovalsResponsibleController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somApprovalsResponsibles.index',['som_form_approvals_id'=> $som_form_approvals_id]));
        }  
            
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Approvals Responsible deleted successfully.');

        return redirect(route('somApprovalsResponsibles.index',['som_form_approvals_id'=> $som_form_approvals_id]));
    }
}
