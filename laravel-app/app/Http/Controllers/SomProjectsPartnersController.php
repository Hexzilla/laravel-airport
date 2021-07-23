<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsPartnersRequest;
use App\Http\Requests\UpdateSomProjectsPartnersRequest;
use App\Repositories\SomProjectsPartnersRepository;
use App\Repositories\SomProjectsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

class SomProjectsPartnersController extends AppBaseController
{
    /** @var  SomProjectsPartnersRepository */
    private $somProjectsPartnersRepository;
    private $somProjectsRepository;

    public function __construct(SomProjectsPartnersRepository $somProjectsPartnersRepo,
                                SomProjectsRepository $somProjectsRepo)
    {
        $this->somProjectsPartnersRepository = $somProjectsPartnersRepo;
        $this->somProjectsRepository = $somProjectsRepo;
    }

    /**
     * Display a listing of the SomProjectsPartners.
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

            $data = $this->somProjectsPartnersRepository->all(['som_projects_id'=>$somProjectsID]);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    $action .= "<a href=\"".route('somProjectsPartners.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somProjectsPartners.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_projects_partners.index')
            ->with('somProjectID',$somProjectsID)
            ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomProjectsPartners.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

        return view('som_projects_partners.create')->with('somProjectID', $request->input('som_project_id'));
    }
    /**
     * Store a newly created SomProjectsPartners in storage.
     *
     * @param CreateSomProjectsPartnersRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsPartnersRequest $request)
    {
        $input = $request->all();

        try{

            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }           

            $somProjectsPartners = $this->somProjectsPartnersRepository->create($input);
            
        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomProjectsPartnersController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsPartners.index',['project_id'=> $input['som_projects_id']]));
        } 
        
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects Partners saved successfully.');

        return redirect(route('somProjectsPartners.index',['project_id'=> $input['som_projects_id']]));
    }

    /**
     * Display the specified SomProjectsPartners.
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

        $somProjectsPartners = $this->somProjectsPartnersRepository->find($id);

        if (empty($somProjectsPartners)) {
            Flash::error('Som Projects Partners not found');

            return redirect(route('somProjects.index'));
        }

        return view('som_projects_partners.show')->with('somProjectsPartners', $somProjectsPartners);
    }

    /**
     * Show the form for editing the specified SomProjectsPartners.
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

        $somProjectsPartners = $this->somProjectsPartnersRepository->find($id);

        if (empty($somProjectsPartners)) {
            Flash::error('Som Projects Partners not found');

            return redirect(route('somProjects.index'));
        }

        return view('som_projects_partners.edit')
            ->with('somProjectsPartners', $somProjectsPartners)
            ->with('somProjectID', $somProjectsPartners->som_projects_id);
    }

    /**
     * Update the specified SomProjectsPartners in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsPartnersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsPartnersRequest $request)
    {
        $project_id = 0;

        try{

            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somProjectsPartners = $this->somProjectsPartnersRepository->find($id);                       

            if (empty($somProjectsPartners)) {
                Flash::error('Som Projects Partners not found');

                return redirect(route('somProjects.index'));
            }

            $project_id = $somProjectsPartners->som_projects_id; 

            $somProjectsPartners = $this->somProjectsPartnersRepository->update($request->all(), $id);

        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomProjectsPartnersController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsPartners.index',['project_id'=> $project_id]));
        } 
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects Partners updated successfully.');

        return redirect(route('somProjectsPartners.index',['project_id'=> $somProjectsPartners['som_projects_id']]));
    }

    /**
     * Remove the specified SomProjectsPartners from storage.
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

            $somProjectsPartners = $this->somProjectsPartnersRepository->find($id);

            if (empty($somProjectsPartners)) {
                Flash::error('Som Projects Partners not found');

                return redirect(route('somProjects.index'));
            }

            $project_id = $somProjectsPartners->som_projects_id;         

            $this->somProjectsPartnersRepository->delete($id);
        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomProjectsPartnersController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsPartners.index',['project_id'=> $project_id]));
        } 
            
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects Partners deleted successfully.');

        return redirect(route('somProjectsPartners.index',['project_id'=> $somProjectsPartners['som_projects_id']]));
    }
}
