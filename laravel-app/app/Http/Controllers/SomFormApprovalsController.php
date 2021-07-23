<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomFormApprovalsRequest;
use App\Http\Requests\UpdateSomFormApprovalsRequest;
use App\Repositories\SomFormApprovalsRepository;
use App\Repositories\SomFormsRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\SomFormApprovals;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

class SomFormApprovalsController extends AppBaseController
{
    /** @var  SomFormApprovalsRepository */
    private $somFormApprovalsRepository;
    private $somFormsRepository;

    public function __construct(
    			SomFormApprovalsRepository $somFormApprovalsRepo, 
    			SomFormsRepository $somFromsRepo)
    {
        $this->somFormApprovalsRepository = $somFormApprovalsRepo;
        $this->somFormsRepository = $somFromsRepo;
    }

    /**
     * Display a listing of the SomFormApprovals.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somforms_id = $request->get('somforms_id');
        // $somFormApprovals = $this->somFormApprovalsRepository->all(['som_forms_id'=>$somforms_id]);

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

        if(!empty($somforms_id)){
            $bradeAry = $this->somFormsRepository->getbreadcrumbsById($somforms_id); 

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
            $breadcrumbs[3]['id'] = $somforms_id; 
            $breadcrumbs[3]['name'] = $bradeAry[0]['name'];
        }

        if ($request->ajax()) {

            $data = $this->somFormApprovalsRepository->all(['som_forms_id'=>$somforms_id]);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button Responsibles                    
                    $action .= "<a href=\"".route("somApprovalsResponsibles.index",['som_form_approvals_id'=> $row->id])."\" class='btn btn-default btn-xs'><i class='fa fa-users'></i> Responsibles</a>";

                    //button show                
                    $action .= "<a href=\"".route('somFormApprovals.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somFormApprovals.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_form_approvals.index')
            ->with('somforms_id', $somforms_id)
            ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomFormApprovals.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

        $somforms_id = $request->get('somforms_id');
        $somFormApprovals = new SomFormApprovals();
        $somFormApprovals->som_forms_id = $somforms_id;
        $somFormApprovals->order = 1;
        $somFormApprovals->som_status_id = 0;
     
        $somForms= $this->somFormsRepository->all([], null, null, ['id', 'name'])->toArray();
        $somFormsIds[] =  '**Please Select a formId';
        foreach($somForms as $rows)
        {
            $somFormsIds[$rows['id']] = $rows['name']."(".$rows['id'].")";
        }

        return view('som_form_approvals.create')
                ->with('somforms_id', $somforms_id)
                ->with('somFormsIds', $somFormsIds )
                ->with('somFormApprovals', $somFormApprovals );
    }

    /**
     * Store a newly created SomFormApprovals in storage.
     *
     * @param CreateSomFormApprovalsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomFormApprovalsRequest $request)
    {
        $input = $request->all();
        $somforms_id = $request->get('som_forms_id');

        try{
            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $somFormApprovals = $this->somFormApprovalsRepository->create($input);
        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomFormApprovalsController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somFormApprovals.index', ['somforms_id'=>$somforms_id]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Form Approvals saved successfully.');
        
        return redirect(route('somFormApprovals.index', ['somforms_id'=>$somforms_id]));
    }

    /**
     * Display the specified SomFormApprovals.
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

        $somFormApprovals = $this->somFormApprovalsRepository->find($id);

        if (empty($somFormApprovals)) {
            Flash::error('Som Form Approvals not found');

            return redirect(route('somFormApprovals.index'));
        }

        $somforms_id = $somFormApprovals->som_forms_id;
        return view('som_form_approvals.show')
                ->with('somforms_id', $somforms_id)
		        ->with('somFormApprovals', $somFormApprovals);
    }

    /**
     * Show the form for editing the specified SomFormApprovals.
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

        $somFormApprovals = $this->somFormApprovalsRepository->find($id);

        $somforms_id = $somFormApprovals->som_forms_id;

        $somForms= $this->somFormsRepository->all([], null, null, ['id', 'name']);
        
        $formsIds[] =  '**Please Select a formId';
        foreach($somForms->toArray() as $rows)
        {
            $formsIds[$rows['id']] = $rows['name']."(".$rows['id'].")";
        }



        if (empty($somFormApprovals)) {
            Flash::error('Som Form Approvals not found');

            return redirect(route('somFormApprovals.index'));
        }

        return view('som_form_approvals.edit')
            ->with('somFormApprovals', $somFormApprovals)
            ->with('somFormsIds', $formsIds)
            ->with('somforms_id', $somforms_id);
    }

    /**
     * Update the specified SomFormApprovals in storage.
     *
     * @param int $id
     * @param UpdateSomFormApprovalsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomFormApprovalsRequest $request)
    {
        $somforms_id = $request->get('som_forms_id'); 
        
        try{

            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somFormApprovals = $this->somFormApprovalsRepository->find($id);

            if (empty($somFormApprovals)) {
                Flash::error('Som Form Approvals not found');

                return redirect(route('somFormApprovals.index'));
            }

            $somFormApprovals = $this->somFormApprovalsRepository->update($request->all(), $id);

        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomFormApprovalsController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somFormApprovals.index', ['somforms_id'=>$somforms_id]));
        }   
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Form Approvals updated successfully.');
        $somforms_id = $somFormApprovals->som_forms_id;
        return redirect(route('somFormApprovals.index', ['somforms_id'=>$somforms_id]));
    }

    /**
     * Remove the specified SomFormApprovals from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somforms_id = 0;

        try{

            if(!CRUDBooster::isDelete()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_delete",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somFormApprovals = $this->somFormApprovalsRepository->find($id);

            if (empty($somFormApprovals)) {
                Flash::error('Som Form Approvals not found');

                return redirect(route('somFormApprovals.index'));
            }
            $somforms_id = $somFormApprovals->som_forms_id;

            $this->somFormApprovalsRepository->delete($id);
            
        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomFormApprovalsController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somFormApprovals.index', ['somforms_id'=>$somforms_id]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Form Approvals deleted successfully.');

        return redirect(route('somFormApprovals.index', ['somforms_id'=>$somforms_id]));
    }
}
