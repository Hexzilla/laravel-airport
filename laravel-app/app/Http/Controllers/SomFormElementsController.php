<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomFormElementsRequest;
use App\Http\Requests\UpdateSomFormElementsRequest;
use App\Repositories\SomFormElementsRepository;
use App\Repositories\CmsPrivilegesRolesRepository;
use App\Repositories\cmsPrivilegesRepository;
use App\Repositories\SomFormsRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\SomFormElements;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Flash;
use Response;

use DataTables;
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

class SomFormElementsController extends AppBaseController
{
    /** @var  SomFormElementsRepository */
    private $somFormElementsRepository;

     /** @var  CmsPrivilegesRolesRepository */
    private $cmsPrivilegesRolesRepository;
    private $cmsPrivilegesRepository;
    private $somFormsRepository;

    public function __construct(
            SomFormElementsRepository $somFormElementsRepo, 
            CmsPrivilegesRolesRepository $cmsPrivilegesRolesRepo,
            cmsPrivilegesRepository $cmsPrivilegesRepo,
            SomFormsRepository $somFormsRepo)
    {
        $this->somFormElementsRepository = $somFormElementsRepo;
        $this->cmsPrivilegesRolesRepository = $cmsPrivilegesRolesRepo;
        $this->cmsPrivilegesRepository = $cmsPrivilegesRepo;
        $this->somFormsRepository = $somFormsRepo;
    }

    /**
     * Display a listing of the SomFormElements.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somforms_id = $request->get('somforms_id');
        // $somFormElements = $this->somFormElementsRepository->all(['som_forms_id'=>$somforms_id]);

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

            $data = $this->somFormElementsRepository->all(['som_forms_id'=>$somforms_id]);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    $action .= "<a href=\"".route('somFormElements.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somFormElements.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_form_elements.index')
            ->with('somforms_id', $somforms_id)
            ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomFormElements.
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
        $somFormElements = new SomFormElements();
        $somFormElements->som_forms_id = $somforms_id;
        $somFormElements->order = 1;
        $somFormElements->som_status_id = 0;

        $arrRole = array();
        $arrRole[] = 'Please select a Privilege';
        $roleEditor = config('constants.UserPrivileges.Editor');
        $roleLegal = config('constants.UserPrivileges.Legal');
        $roleFinance = config('constants.UserPrivileges.Finance');
        $filter = array($roleEditor, $roleLegal ,$roleFinance);
        $RoleRows = $this->cmsPrivilegesRepository->find($filter)->toArray();
        foreach($RoleRows as $row)
        {
            $arrRole[$row['id']] = $row['name'];
        }

        $elementTypes['-1'] = 'Please select a Element type';
        $elementTypes = $elementTypes + config('constants.elementTypes');
        return view('som_form_elements.create')
                ->with('somforms_id', $somforms_id)
                ->with('arrRole', $arrRole )
                ->with('elementTypes', $elementTypes)
                ->with('somFormElements', $somFormElements );
    }

    /**
     * Store a newly created SomFormElements in storage.
     *
     * @param CreateSomFormElementsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomFormElementsRequest $request)
    {
        $somforms_id = $request->get('som_forms_id');

        try{

            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $input = $request->all();

            $somFormElements = $this->somFormElementsRepository->create($input);

        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomFormElementsController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somFormElements.index', ['somforms_id'=>$somforms_id]));
        } 
            
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Form Elements saved successfully.');
        
        return redirect(route('somFormElements.index', ['somforms_id'=>$somforms_id]));
    }

    /**
     * Display the specified SomFormElements.
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

        $somFormElements = $this->somFormElementsRepository->find($id);

        if (empty($somFormElements)) {
            Flash::error('Som Form Elements not found');

            return redirect(route('somFormElements.index'));
        }

        $somforms_id = $somFormElements->som_forms_id;
        return view('som_form_elements.show')
            ->with('somFormElements', $somFormElements)
            ->with('somforms_id', $somforms_id);
    }

    /**
     * Show the form for editing the specified SomFormElements.
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

        $somFormElements = $this->somFormElementsRepository->find($id);
        

        if (empty($somFormElements)) {
            Flash::error('Som Form Elements not found');

            return redirect(route('somFormElements.index'));
        }

        $somforms_id = $somFormElements->som_forms_id;

        $arrRole = array();
        $arrRole[] = 'Please select a Privilege';
        $roleEditor = config('constants.UserPrivileges.Editor');
        $roleLegal = config('constants.UserPrivileges.Legal');
        $roleFinance = config('constants.UserPrivileges.Finance');
        $filter = array($roleEditor, $roleLegal ,$roleFinance);
        $RoleRows = $this->cmsPrivilegesRepository->find($filter)->toArray();
        foreach($RoleRows as $row)
        {
            $arrRole[$row['id']] = $row['name'];
        }

        $elementTypes['-1'] = 'Please select a Element type';
        $elementTypes = $elementTypes + config('constants.elementTypes');

        return view('som_form_elements.edit')
            ->with('somforms_id', $somforms_id)
            ->with('somFormElements', $somFormElements)
            ->with('elementTypes', $elementTypes)
            ->with('arrRole', $arrRole);
    }

    /**
     * Update the specified SomFormElements in storage.
     *
     * @param int $id
     * @param UpdateSomFormElementsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomFormElementsRequest $request)
    {
        $somforms_id = $request->get('som_forms_id');

        try{

            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somFormElements = $this->somFormElementsRepository->find($id);

            if (empty($somFormElements)) {
                Flash::error('Som Form Elements not found');

                return redirect(route('somFormElements.index'));
            }

            $somFormElements = $this->somFormElementsRepository->update($request->all(), $id);

        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomFormElementsController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somFormElements.index' , ['somforms_id'=>$somforms_id]));
        } 
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Form Elements updated successfully.');
        
        return redirect(route('somFormElements.index' , ['somforms_id'=>$somforms_id]));
    }

    /**
     * Remove the specified SomFormElements from storage.
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

            $somFormElements = $this->somFormElementsRepository->find($id);

            if (empty($somFormElements)) {
                Flash::error('Som Form Elements not found');

                return redirect(route('somFormElements.index'));
            }
            $somforms_id = $somFormElements->som_forms_id;

            $this->somFormElementsRepository->delete($id);

        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomFormElementsController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somFormElements.index', ['somforms_id'=>$somforms_id]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Form Elements deleted successfully.');

        return redirect(route('somFormElements.index', ['somforms_id'=>$somforms_id]));
    }
}
