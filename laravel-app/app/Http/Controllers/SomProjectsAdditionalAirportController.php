<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsAdditionalAirportRequest;
use App\Http\Requests\UpdateSomProjectsAdditionalAirportRequest;
use App\Repositories\SomProjectsAdditionalAirportRepository;
use App\Repositories\SomProjectsAirportRepository;
use App\Repositories\SomProjectsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

class SomProjectsAdditionalAirportController extends AppBaseController
{
    /** @var  SomProjectsAdditionalAirportRepository */
    private $somProjectsAdditionalAirportRepository;
    private $somProjectsAirportRepository;
    private $somProjectsRepository;

    public function __construct(
        SomProjectsAdditionalAirportRepository $somProjectsAdditionalAirportRepo,
        SomProjectsAirportRepository $somProjectsAirportRepo,
        SomProjectsRepository $somProjectsRepo
        )
    {
        $this->somProjectsAdditionalAirportRepository = $somProjectsAdditionalAirportRepo;
        $this->somProjectsAirportRepository = $somProjectsAirportRepo;
        $this->somProjectsRepository = $somProjectsRepo; 
    }

    /**
     * Display a listing of the SomProjectsAdditionalAirport.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //JOIN BY PROJECT_ID---
        $projectId = $request->input('project_id');

        $somProjects = $this->somProjectsRepository->find($projectId);
        $breadcrumbs = array();
        $breadcrumbs[0] = array();
        $breadcrumbs[0]['id'] = $somProjects['id'];
        $breadcrumbs[0]['name'] = $somProjects['name'];
        //---------------------

        if ($request->ajax()) {

            $data = $this->somProjectsAdditionalAirportRepository->getAllData($projectId);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    // $action .= "<a href=\"".route('somProjectsAdditionalAirports.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    // $action .= "<i class='far fa-eye'></i>";
                    // $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somProjectsAdditionalAirports.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_projects_additional_airports.index')
            ->with('projectId', $projectId)
            ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomProjectsAdditionalAirport.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

    	$somProjectsId = $request->input('project_id');
        $somProjectsAirports= $this->somProjectsAirportRepository->all([], null, null, ['id', 'name']);
        
        $airports = array(0 => '**Please Select a Airport');
        foreach($somProjectsAirports->toArray() as $rows)
        {
            $airports[$rows['id']] = $rows['name'];
        }
        return view('som_projects_additional_airports.create')
                    ->with('somEditId', 0)
                    ->with('somProjectsId', $somProjectsId)
                    ->with('somProjectsAirports', $airports)
                    ->with('selectedItem', 0);

    }

    /**
     * Store a newly created SomProjectsAdditionalAirport in storage.
     *
     * @param CreateSomProjectsAdditionalAirportRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsAdditionalAirportRequest $request)
    {
        $input = $request->all();
        $projectId = $request->input('som_project_id');

        try{

            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }
            
            $somProjectsAdditionalAirport = $this->somProjectsAdditionalAirportRepository->create($input);

        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomProjectsAdditionalAirportController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsAdditionalAirports.index', ['project_id' => $projectId]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects Additional Airport saved successfully.');        
        
        return redirect(route('somProjectsAdditionalAirports.index', ['project_id' => $projectId]));
    }

    /**
     * Display the specified SomProjectsAdditionalAirport.
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

        $somProjectsAdditionalAirport = $this->somProjectsAdditionalAirportRepository->find($id);

        if (empty($somProjectsAdditionalAirport)) {
            Flash::error('Som Projects Additional Airport not found');

            return redirect(route('somProjectsAdditionalAirports.index'));
        }

        return view('som_projects_additional_airports.show')->with('somProjectsAdditionalAirport', $somProjectsAdditionalAirport);
    }

    /**
     * Show the form for editing the specified SomProjectsAdditionalAirport.
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

        $somProjectsAdditionalAirport = $this->somProjectsAdditionalAirportRepository->find($id);
        if (empty($somProjectsAdditionalAirport)) {
            Flash::error('Som Projects Additional Airport not found');

            return redirect(route('somProjectsAdditionalAirports.index'));
        }

        $somProjectsAirports= $this->somProjectsAirportRepository->all([], null, null, ['id', 'name']);
        $somProjectsId = $somProjectsAdditionalAirport->som_project_id;
        $selectedItem = $somProjectsAdditionalAirport->som_airport_id;
        $airports = array(0 => '**Please Select a Airport');
        foreach($somProjectsAirports->toArray() as $rows)
        {
            $airports[$rows['id']] = $rows['name'];
        }
        return view('som_projects_additional_airports.edit')
            ->with('somEditId', $id)
            ->with('somProjectsId', $somProjectsId)
            ->with('somProjectsAirports', $airports )
            ->with('selectedItem', $selectedItem)
            ->with('somProjectsAdditionalAirport', $somProjectsAdditionalAirport);
    }

    /**
     * Update the specified SomProjectsAdditionalAirport in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsAdditionalAirportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsAdditionalAirportRequest $request)
    {
        $projectId = $request->input('som_project_id');

        try{

            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somProjectsAdditionalAirport = $this->somProjectsAdditionalAirportRepository->find($id);

            if (empty($somProjectsAdditionalAirport)) {
                Flash::error('Som Projects Additional Airport not found');

                return redirect(route('somProjectsAdditionalAirports.index'));
            }

            $somProjectsAdditionalAirport = $this->somProjectsAdditionalAirportRepository->update($request->all(), $id);

        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomProjectsAdditionalAirportController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsAdditionalAirports.index', ['project_id' => $projectId]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects Additional Airport updated successfully.');

        return redirect(route('somProjectsAdditionalAirports.index', ['project_id' => $projectId]));
    }

    /**
     * Remove the specified SomProjectsAdditionalAirport from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsId = 0;

        try{

            if(!CRUDBooster::isDelete()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_delete",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somProjectsAdditionalAirport = $this->somProjectsAdditionalAirportRepository->find($id); 

            if (empty($somProjectsAdditionalAirport)) {
                Flash::error('Som Projects Additional Airport not found');

                return redirect(route('somProjectsAdditionalAirports.index'));
            }

            $somProjectsId = $somProjectsAdditionalAirport->som_project_id;

            $this->somProjectsAdditionalAirportRepository->delete($id);
            
        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomProjectsAdditionalAirportController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somProjectsAdditionalAirports.index', ['project_id' => $somProjectsId]));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Projects Additional Airport deleted successfully.');

        return redirect(route('somProjectsAdditionalAirports.index', ['project_id' => $somProjectsId]));
    }
}