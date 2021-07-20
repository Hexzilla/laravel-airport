<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomStatusApprovalsRequest;
use App\Http\Requests\UpdateSomStatusApprovalsRequest;
use App\Repositories\SomStatusApprovalsRepository;
use App\Repositories\SomApprovalsResponsibleRepository;
use App\Repositories\SomStatusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;

class SomStatusApprovalsController extends AppBaseController
{
    /** @var  SomStatusApprovalsRepository */
    private $somStatusApprovalsRepository;
    private $somApprovalsResponsibleRepository;
    private $somStatusRepository;

    public function __construct(SomStatusApprovalsRepository $somStatusApprovalsRepo,
                                SomApprovalsResponsibleRepository $somApprovalsResponsibleRepo,
                                SomStatusRepository $somStatusRepository)
    {
        $this->somStatusApprovalsRepository = $somStatusApprovalsRepo;
        $this->somApprovalsResponsibleRepository = $somApprovalsResponsibleRepo;
        $this->somStatusRepository = $somStatusRepository;
    }

    /**
     * Display a listing of the SomStatusApprovals.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $som_approvals_responsible_id = $request->get('som_approvals_responsible_id');
        /*$somStatusApprovals = $this->somStatusApprovalsRepository->all(['som_approvals_responsible_id'=>$som_approvals_responsible_id]);*/

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
        $breadcrumbs[5] = array();
        $breadcrumbs[5]['id'] = 0;
        $breadcrumbs[5]['name'] = "";

        if(!empty($som_approvals_responsible_id)){
            $bradeAry = $this->somApprovalsResponsibleRepository->getbreadcrumbsById($som_approvals_responsible_id); 

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
            $breadcrumbs[4]['id'] = $bradeAry[0]['som_form_approvals_id'];
            $breadcrumbs[4]['name'] = $bradeAry[0]['som_form_approvals_name'];
            //responsibles
            $breadcrumbs[5]['id'] = $som_approvals_responsible_id; 
            $breadcrumbs[5]['name'] = "";
        }

        if ($request->ajax()) {

            $data = $this->somStatusApprovalsRepository->all(['som_approvals_responsible_id'=>$som_approvals_responsible_id]);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    $action .= "<a href=\"".route('somStatusApprovals.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somStatusApprovals.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-edit'></i>";

                    //button delete
                    $action .= "</a>";
                    $action .= "<button class='btn btn-danger btn-xs' onclick='openDeleteModal(\"".$row->id."\")'><i class='far fa-trash-alt'></i></button>";

                    $action .= "</div>";
                    return $action;                        
                })                    
                ->rawColumns(['action'])                
                ->make(true);
        }

        return view('som_status_approvals.index')
            ->with('som_approvals_responsible_id', $som_approvals_responsible_id)
            ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomStatusApprovals.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $som_approvals_responsible_id = $request->get("som_approvals_responsible_id");

        $data = array();
        $data['somStatuses'] = array();
        $somStatuses = $this->somStatusRepository->all();
        $selected_status_id = 0;
        foreach ($somStatuses as $somStatus) {
            $data['somStatuses'][$somStatus->id] = $somStatus->name."  (".$somStatus->type.")";
        }  
        $data['selected_status_id'] = $selected_status_id;

        return view('som_status_approvals.create')
                    ->with('som_approvals_responsible_id',$som_approvals_responsible_id)
                    ->with('data',$data);
    }

    /**
     * Store a newly created SomStatusApprovals in storage.
     *
     * @param CreateSomStatusApprovalsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomStatusApprovalsRequest $request)
    {
        $input = $request->all();
        $som_approvals_responsible_id = $request->input('som_approvals_responsible_id');

        $somStatusApprovals = $this->somStatusApprovalsRepository->create($input);

        Flash::success('Som Status Approvals saved successfully.');

        return redirect(route('somStatusApprovals.index',['som_approvals_responsible_id'=> $som_approvals_responsible_id]));
    }

    /**
     * Display the specified SomStatusApprovals.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somStatusApprovals = $this->somStatusApprovalsRepository->find($id);

        if (empty($somStatusApprovals)) {
            Flash::error('Som Status Approvals not found');

            return redirect(route('somStatusApprovals.index'));
        }

        $som_approvals_responsible_id = $somStatusApprovals->som_approvals_responsible_id;

        return view('som_status_approvals.show')
            ->with('som_approvals_responsible_id', $som_approvals_responsible_id)
            ->with('somStatusApprovals', $somStatusApprovals);
    }

    /**
     * Show the form for editing the specified SomStatusApprovals.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somStatusApprovals = $this->somStatusApprovalsRepository->find($id);

        if (empty($somStatusApprovals)) {
            Flash::error('Som Status Approvals not found');

            return redirect(route('somStatusApprovals.index'));
        }

        $data = array();
        $data['somStatuses'] = array();
        $somStatuses = $this->somStatusRepository->all();
        $selected_status_id = 0;
        foreach ($somStatuses as $somStatus) {
            $data['somStatuses'][$somStatus->id] = $somStatus->name."  (".$somStatus->type.")";
        }  
        
        $data['selected_status_id'] = $somStatusApprovals->som_status_id;

        return view('som_status_approvals.edit')
                ->with('som_approvals_responsible_id',$somStatusApprovals->som_approvals_responsible_id)
                ->with('data', $data)
                ->with('somStatusApprovals', $somStatusApprovals);
    }

    /**
     * Update the specified SomStatusApprovals in storage.
     *
     * @param int $id
     * @param UpdateSomStatusApprovalsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomStatusApprovalsRequest $request)
    {
        $somStatusApprovals = $this->somStatusApprovalsRepository->find($id);
        $som_approvals_responsible_id = $request->input('som_approvals_responsible_id');
        if (empty($somStatusApprovals)) {
            Flash::error('Som Status Approvals not found');

            return redirect(route('somStatusApprovals.index',['som_approvals_responsible_id'=> $som_approvals_responsible_id]));
        }        

        $somStatusApprovals = $this->somStatusApprovalsRepository->update($request->all(), $id);

        Flash::success('Som Status Approvals updated successfully.');

        return redirect(route('somStatusApprovals.index',['som_approvals_responsible_id'=> $som_approvals_responsible_id]));
    }

    /**
     * Remove the specified SomStatusApprovals from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $somStatusApprovals = $this->somStatusApprovalsRepository->find($id);
        $som_approvals_responsible_id = $request->input('som_approvals_responsible_id');  

        if (empty($somStatusApprovals)) {
            Flash::error('Som Status Approvals not found');

            return redirect(route('somStatusApprovals.index',['som_approvals_responsible_id'=> $som_approvals_responsible_id]));
        }

        $this->somStatusApprovalsRepository->delete($id);

        Flash::success('Som Status Approvals deleted successfully.');

        return redirect(route('somStatusApprovals.index',['som_approvals_responsible_id'=> $som_approvals_responsible_id]));
    }
}
