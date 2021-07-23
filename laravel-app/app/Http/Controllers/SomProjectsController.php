<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsRequest;
use App\Http\Requests\UpdateSomProjectsRequest;
use App\Repositories\SomProjectsRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SomStatusRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

class SomProjectsController extends AppBaseController
{
    /** @var  SomProjectsRepository */
    private $somProjectsRepository;
    private $somStatusRepository;
    public function __construct(
            SomProjectsRepository $somProjectsRepo,
            SomStatusRepository $somStatusRepo)
    {
        $this->somProjectsRepository = $somProjectsRepo;
        $this->somStatusRepository = $somStatusRepo;
    }

    /**
     * Display a listing of the SomProjects.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {        
        if ($request->ajax()) {

            $data = $this->somProjectsRepository->getAllData();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('is_template_project', function ($request) {
                    $html = "";
                    if ($request->is_template_project){
                        $html = '<i class="fas fa-key"></i>';
                    }
                    return $html; 
                })
                ->editColumn('img_url', function ($request) {
                    $html = "<img src=\"".$request->img_url."\" alt=\"".$request->name."\">";
                    return $html; 
                })
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button Users                   
                    $action .= "<a href=\"". route('somProjectUsers.index', ['project_id' => $row->id])."\" class='btn btn-default btn-xs'>
                        <i class='fas fa-users'></i>Users</a>";

                    //button Additional Airports 
                    $action .= "<a href=\"". route('somProjectsAdditionalAirports.index', ['project_id' => $row->id])."\" class='btn btn-default btn-xs'><i class='fas fa-plane'></i>Additional Airports</a>";

                    //button Phases
                    $action .= "<a href=\"". route('somProjectsPhases.index', ['project_id' => $row->id])."\" class='btn btn-default btn-xs'>
                            <i class='fas fa-film'></i>Phases</a>";

                    //button Partners
                    $action .= "<a href=\"". route('somProjectsPartners.index', ['project_id' => $row->id])."\" class='btn btn-default btn-xs'>
                            <i class='far fa-object-group'></i>Partners</a>";

                    //button Advisors
                    $action .= "<a href=\"". route('somProjectsAdvisors.index', ['project_id' => $row->id])."\" class='btn btn-default btn-xs'>
                            <i class='fas fa-users'></i>Advisors</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somProjects.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-edit'></i>";

                    //button delete
                    $action .= "</a>";
                    $action .= "<button class='btn btn-danger btn-xs' onclick='openDeleteModal(\"".$row->id."\")'><i class='far fa-trash-alt'></i></button>";

                    $action .= "</div>";
                    return $action;                        
                })                    
                ->rawColumns(['is_template_project','img_url','action'])                
                ->make(true);
        }else{
            if (!CRUDBooster::isView()) {
              CRUDBooster::insertLog(trans("crudbooster.log_try_view",['module'=>CRUDBooster::getCurrentModule()->name]));
              CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
            }
        }
        return view('som_projects.index');
    }

    /**
     * Show the form for creating a new SomProjects.
     *
     * @return Response
     */
    public function create()
    {
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

        $statusArray = array();
        $sel_status_id = 0;
        $statusRows = $this->somStatusRepository->all(['type'=>'projects'], null, null, ['id','name']);
        foreach($statusRows as $row)
        {
            $statusArray[$row['id']] = $row['name'];
        }
        return view('som_projects.create')
                    ->with('statusArray', $statusArray)
                    ->with('sel_status', $sel_status_id);
    }

    /**
     * Store a newly created SomProjects in storage.
     *
     * @param CreateSomProjectsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsRequest $request)
    {
        try{

            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $input = $request->all();

            $somProjects = $this->somProjectsRepository->create($input);

        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomProjectsController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjects.index'));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects saved successfully.');

        return redirect(route('somProjects.index'));
    }

    /**
     * Display the specified SomProjects.
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

        $somProjects = $this->somProjectsRepository->find($id);

        if (empty($somProjects)) {
            Flash::error('Som Projects not found');

            return redirect(route('somProjects.index'));
        }

        return view('som_projects.show')->with('somProjects', $somProjects);
    }

    /**
     * Show the form for editing the specified SomProjects.
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

        $somProjects = $this->somProjectsRepository->find($id);

        if (empty($somProjects)) {
            Flash::error('Som Projects not found');

            return redirect(route('somProjects.index'));
        }

        $statusArray = array();
        $sel_status_id = $somProjects->som_project_info_status_id;
        $statusRows = $this->somStatusRepository->all(['type'=>'projects'], null, null, ['id','name']);
        foreach($statusRows as $row)
        {
            $statusArray[$row['id']] = $row['name'];
        }
        return view('som_projects.edit')
                ->with('statusArray', $statusArray)
                ->with('sel_status', $sel_status_id)
                ->with('somProjects', $somProjects);
    }

    /**
     * Update the specified SomProjects in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsRequest $request)
    {
        try{

            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somProjects = $this->somProjectsRepository->find($id);

            if (empty($somProjects)) {
                Flash::error('Som Projects not found');

                return redirect(route('somProjects.index'));
            }

            $somProjects = $this->somProjectsRepository->update($request->all(), $id);

        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomProjectsController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjects.index'));
        }        
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects updated successfully.');

        return redirect(route('somProjects.index'));
    }

    /**
     * Remove the specified SomProjects from storage.
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

            $somProjects = $this->somProjectsRepository->find($id);

            if (empty($somProjects)) {
                Flash::error('Som Projects not found');

                return redirect(route('somProjects.index'));
            }

            $this->somProjectsRepository->delete($id);
            
        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomProjectsController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjects.index'));
        } 
            
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects deleted successfully.');

        return redirect(route('somProjects.index'));
    }
}
