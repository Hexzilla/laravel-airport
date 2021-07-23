<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsUsersRequest;
use App\Http\Requests\UpdateCmsUsersRequest;
use App\Repositories\CmsUsersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

class CmsUsersController extends AppBaseController
{
    /** @var  CmsUsersRepository */
    private $cmsUsersRepository;

    public function __construct(CmsUsersRepository $cmsUsersRepo)
    {
        $this->cmsUsersRepository = $cmsUsersRepo;
    }

    /**
     * Display a listing of the CmsUsers.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = $this->cmsUsersRepository->all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($request) {
                    $created_at = "";
                    if(!empty($request->created_at)){
                        $created_at = date('Y-m-d H:i:s', strtotime($request->created_at));
                    }
                    return $created_at; 
                })
                ->editColumn('updated_at', function ($request) {
                    $updated_at = "";
                    if(!empty($request->updated_at)){
                        $updated_at = date('Y-m-d H:i:s', strtotime($request->updated_at));
                    }
                    return $updated_at; 
                })
                ->editColumn('password', function ($request) {     
                    $password = "";
                    if(!empty($request->password)){
                        $password = $request->password;
                    }
                    return $password;  
                })
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    $action .= "<a href=\"".route('cmsUsers.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('cmsUsers.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('cms_users.index');
    }

    /**
     * Show the form for creating a new CmsUsers.
     *
     * @return Response
     */
    public function create()
    {
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

        return view('cms_users.create');
    }

    /**
     * Store a newly created CmsUsers in storage.
     *
     * @param CreateCmsUsersRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsUsersRequest $request)
    {
        try{

            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $input = $request->all();

            $cmsUsers = $this->cmsUsersRepository->create($input);

        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error CmsUsersController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('cmsUsers.index'));
        } 
            
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Cms Users saved successfully.');

        return redirect(route('cmsUsers.index'));
    }

    /**
     * Display the specified CmsUsers.
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

        $cmsUsers = $this->cmsUsersRepository->find($id);

        if (empty($cmsUsers)) {
            Flash::error('Cms Users not found');

            return redirect(route('cmsUsers.index'));
        }

        return view('cms_users.show')->with('cmsUsers', $cmsUsers);
    }

    /**
     * Show the form for editing the specified CmsUsers.
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

        $cmsUsers = $this->cmsUsersRepository->find($id);

        if (empty($cmsUsers)) {
            Flash::error('Cms Users not found');

            return redirect(route('cmsUsers.index'));
        }

        return view('cms_users.edit')->with('cmsUsers', $cmsUsers);
    }

    /**
     * Update the specified CmsUsers in storage.
     *
     * @param int $id
     * @param UpdateCmsUsersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsUsersRequest $request)
    {
        try{

            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $cmsUsers = $this->cmsUsersRepository->find($id);

            if (empty($cmsUsers)) {
                Flash::error('Cms Users not found');

                return redirect(route('cmsUsers.index'));
            }

            $cmsUsers = $this->cmsUsersRepository->update($request->all(), $id);

        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error CmsUsersController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('cmsUsers.index'));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Cms Users updated successfully.');

        return redirect(route('cmsUsers.index'));
    }

    /**
     * Remove the specified CmsUsers from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        try{

            if(!CRUDBooster::isDelete()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_delete",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $cmsUsers = $this->cmsUsersRepository->find($id);

            if (empty($cmsUsers)) {
                Flash::error('Cms Users not found');

                return redirect(route('cmsUsers.index'));
            }

            $this->cmsUsersRepository->delete($id);
            
        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error CmsUsersController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('cmsUsers.index'));
        } 

            
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Cms Users deleted successfully.');

        return redirect(route('cmsUsers.index'));
    }
}
