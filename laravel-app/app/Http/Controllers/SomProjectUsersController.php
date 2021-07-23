<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectUsersRequest;
use App\Http\Requests\UpdateSomProjectUsersRequest;
use App\Repositories\SomProjectUsersRepository;
use App\Repositories\SomProjectsRepository;
use App\Repositories\CmsUsersRepository;
use App\Repositories\CmsPrivilegesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DataTables;
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

class SomProjectUsersController extends AppBaseController
{
    /** @var  SomProjectUsersRepository */
    private $somProjectUsersRepository;
    private $somProjectsRepository;
    private $cmsUsersRepository;
    private $cmsPrivilegesRepository;

    public function __construct(SomProjectUsersRepository $somProjectUsersRepo,
                                SomProjectsRepository $somProjectsRepo,
                                CmsUsersRepository $cmsUsersRepository,
                                CmsPrivilegesRepository $cmsPrivilegesRepository)
    {
        $this->somProjectUsersRepository = $somProjectUsersRepo;
        $this->somProjectsRepository = $somProjectsRepo;
        $this->cmsUsersRepository = $cmsUsersRepository; 
        $this->cmsPrivilegesRepository = $cmsPrivilegesRepository;  
    }

    /**
     * Display a listing of the SomProjectUsers.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $project_id = $request->input('project_id');

        $somProjects = $this->somProjectsRepository->find($project_id);
        $breadcrumbs = array();
        $breadcrumbs[0] = array();
        $breadcrumbs[0]['id'] = $somProjects['id'];
        $breadcrumbs[0]['name'] = $somProjects['name'];

        if ($request->ajax()) {

            // $data = $this->somProjectUsersRepository->all();
            $data = $this->somProjectUsersRepository->getDataBySomProjectsId($project_id);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    $action .= "<a href=\"".route('somProjectUsers.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somProjectUsers.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_project_users.index')
                    ->with('project_id', $project_id)
                    ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomProjectUsers.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

        $project_id = $request->input('project_id');

        $data = array();
        $data['users'] = array();
        $cmsUsers = $this->cmsUsersRepository->all();
        $cnt = 0;
        $selected_user_id = 0;
        foreach ($cmsUsers as $cmsuser) {
            $data['users'][$cmsuser->id] = $cmsuser->name;
            /*if($cnt == 0){
                $selected_user_id = $cmsuser->id;
            }
            $cnt++;*/
        }  
        $data['selected_user'] = $selected_user_id;

        $data['privileges'] = array();
        $cmsPrivileges = $this->getProjectPrivileges();
        $cnt = 0;
        $selected_privilege_id = 0;
        foreach ($cmsPrivileges as $cmsPrivilege) {
            $data['privileges'][$cmsPrivilege->id] = $cmsPrivilege->name;
        }  
        $data['selected_privilege'] = $selected_privilege_id;

        return view('som_project_users.create')
                    ->with('project_id', $project_id)
                    ->with('data',$data);
    }

    /**
     * Store a newly created SomProjectUsers in storage.
     *
     * @param CreateSomProjectUsersRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectUsersRequest $request)
    {
        $input = $request->all();
        $som_projects_id = $request->input('som_projects_id');

        try{

            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }              

            $somProjectUsers = $this->somProjectUsersRepository->create($input);

        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomProjectUsersController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectUsers.index',['project_id'=> $som_projects_id]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Project Users saved successfully.');

        return redirect(route('somProjectUsers.index',['project_id'=> $som_projects_id]));
    }

    /**
     * Display the specified SomProjectUsers.
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

        $somProjectUsers = $this->somProjectUsersRepository->getData($id);

        if (empty($somProjectUsers)) {
            Flash::error('Som Project Users not found');

            return redirect(route('somProjectUsers.index'));
        }

        $project_id = $somProjectUsers->som_projects_id;

        return view('som_project_users.show')
                    ->with('project_id', $project_id)
                    ->with('somProjectUsers', $somProjectUsers);
    }

    /**
     * Show the form for editing the specified SomProjectUsers.
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

        $somProjectUsers = $this->somProjectUsersRepository->find($id);

        if (empty($somProjectUsers)) {
            Flash::error('Som Project Users not found');

            return redirect(route('somProjectUsers.index'));
        }

        $data = array();
        $data['users'] = array();
        $cmsuser = $this->cmsUsersRepository->find($somProjectUsers->cms_users_id);
        $data['users'][$cmsuser->id] = $cmsuser->name;
        $selected_user_id = 0;

        $selected_user_id = $somProjectUsers->cms_users_id;
        $data['selected_user'] = $selected_user_id;

        $data['privileges'] = array();
        $cmsPrivileges = $cmsPrivileges = $this->getProjectPrivileges();
        $selected_privilege_id = 0;
        foreach ($cmsPrivileges as $cmsPrivilege) {
            if ($cmsPrivilege->is_project_role == 1) {
                $data['privileges'][$cmsPrivilege->id] = $cmsPrivilege->name;
            }
        }  
        $data['selected_privilege'] = $somProjectUsers->cms_privileges_id;

        return view('som_project_users.edit')
                ->with('somProjectUsers', $somProjectUsers)
                ->with('data',$data)
                ->with('project_id',$somProjectUsers->som_projects_id);
    }

    /**
     * Update the specified SomProjectUsers in storage.
     *
     * @param int $id
     * @param UpdateSomProjectUsersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectUsersRequest $request)
    {
        $som_projects_id = $request->input('som_projects_id'); 

        try{

            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somProjectUsers = $this->somProjectUsersRepository->find($id);            

            if (empty($somProjectUsers)) {
                Flash::error('Som Project Users not found');

                return redirect(route('somProjectUsers.index',['project_id'=> $som_projects_id]));
            }

            $somProjectUsers = $this->somProjectUsersRepository->update($request->all(), $id);

        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomProjectUsersController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectUsers.index',['project_id'=> $som_projects_id]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Project Users updated successfully.');

        return redirect(route('somProjectUsers.index',['project_id'=> $som_projects_id]));
    }

    /**
     * Remove the specified SomProjectUsers from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $project_id = $request->input('project_id');  

        try{
            if(!CRUDBooster::isDelete()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_delete",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somProjectUsers = $this->somProjectUsersRepository->find($id);            

            if (empty($somProjectUsers)) {
                Flash::error('Som Project Users not found');

                return redirect(route('somProjectUsers.index',['project_id'=> $project_id]));
            }

            $this->somProjectUsersRepository->delete($id);
        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomProjectUsersController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectUsers.index',['project_id'=> $project_id]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Project Users deleted successfully.');

        return redirect(route('somProjectUsers.index',['project_id'=> $project_id]));
    }

    function getProjectPrivileges() 
    {
        $projectPrivileges = array();
        $cmsPrivileges = $this->cmsPrivilegesRepository->all();
        foreach ($cmsPrivileges as $cmsPrivilege) {
            if ($cmsPrivilege->is_project_role == 1) {
                $projectPrivileges[] = $cmsPrivilege;
            }
        } 

        return $projectPrivileges;
    }
}
