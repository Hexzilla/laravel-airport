<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsAdvisorsRequest;
use App\Http\Requests\UpdateSomProjectsAdvisorsRequest;
use App\Repositories\SomProjectsAdvisorsRepository;
use App\Repositories\SomProjectsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Http\Utils\CRUDBooster;
use Flash;
use Response;

use DataTables;
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

class SomProjectsAdvisorsController extends AppBaseController
{
    /** @var  SomProjectsAdvisorsRepository */
    private $somProjectsAdvisorsRepository;
    private $somProjectsRepository;

    public function __construct(SomProjectsAdvisorsRepository $somProjectsAdvisorsRepo,
                                SomProjectsRepository $somProjectsRepo)
    {
        $this->somProjectsAdvisorsRepository = $somProjectsAdvisorsRepo;
        $this->somProjectsRepository = $somProjectsRepo;   
    }

    /**
     * Display a listing of the SomProjectsAdvisors.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        
        if($request->input('project_id') == null){
            Flash::error('Som Projects Id not found');
            return redirect(route('somProjects.index'));
        }

        $somProjectsID = $request->input('project_id');
        $somProjects = $this->somProjectsRepository->find($somProjectsID);
        $breadcrumbs = array();
        $breadcrumbs[0] = array();
        $breadcrumbs[0]['id'] = $somProjects['id'];
        $breadcrumbs[0]['name'] = $somProjects['name'];

        if ($request->ajax()) {

            $data = $this->somProjectsAdvisorsRepository->all(['som_projects_id'=>$somProjectsID]);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    $action .= "<a href=\"".route('somProjectsAdvisors.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somProjectsAdvisors.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_projects_advisors.index')
            ->with('somProjectID',$somProjectsID)
            ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomProjectsAdvisors.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

        return view('som_projects_advisors.create')->with('somProjectID',$request->input('som_project_id'));
    }
    /**
     * Store a newly created SomProjectsAdvisors in storage.
     *
     * @param CreateSomProjectsAdvisorsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsAdvisorsRequest $request)
    {
        $input = $request->all();

        try{
            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }           

            $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->create($input);
        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomProjectsAdvisorsController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsAdvisors.index',['project_id'=> $input['som_projects_id']]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects Advisors saved successfully.');

        return redirect(route('somProjectsAdvisors.index',['project_id'=> $input['som_projects_id']]));
    }

    /**
     * Display the specified SomProjectsAdvisors.
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

        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->find($id);

        if (empty($somProjectsAdvisors)) {
            Flash::error('Som Projects Advisors not found');

            return redirect(route('somProjects.index'));
        }

        return view('som_projects_advisors.show')->with('somProjectsAdvisors', $somProjectsAdvisors);
    }

    /**
     * Show the form for editing the specified SomProjectsAdvisors.
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

        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->find($id);

        if (empty($somProjectsAdvisors)) {
            Flash::error('Som Projects Advisors not found');

            return redirect(route('somProjects.index'));
        }

        return view('som_projects_advisors.edit')
            ->with('somProjectsAdvisors', $somProjectsAdvisors)
            ->with('somProjectID', $somProjectsAdvisors->som_projects_id); //0712
    }

    /**
     * Update the specified SomProjectsAdvisors in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsAdvisorsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsAdvisorsRequest $request)
    {
        $som_projects_id = 0;
        try{
            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->find($id);

            if (empty($somProjectsAdvisors)) {
                Flash::error('Som Projects Advisors not found');

                return redirect(route('somProjects.index'));
            }
            $som_projects_id = $somProjectsAdvisors['som_projects_id'];
            $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->update($request->all(), $id);
        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomProjectsAdvisorsController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsAdvisors.index',['project_id'=> $som_projects_id]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects Advisors updated successfully.');

        return redirect(route('somProjectsAdvisors.index',['project_id'=> $som_projects_id]));
    }

    /**
     * Remove the specified SomProjectsAdvisors from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $som_projects_id = 0;

        try{
            if(!CRUDBooster::isDelete()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_delete",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->find($id);

            if (empty($somProjectsAdvisors)) {
                Flash::error('Som Projects Advisors not found');

                return redirect(route('somProjects.index'));
            }
            $som_projects_id = $somProjectsAdvisors['som_projects_id'];

            $this->somProjectsAdvisorsRepository->delete($id);
        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomProjectsAdvisorsController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsAdvisors.index',['project_id'=> $som_projects_id]));
        } 
            
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects Advisors deleted successfully.');

        return redirect(route('somProjectsAdvisors.index',['project_id'=> $som_projects_id]));
    }
}
