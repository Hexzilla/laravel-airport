<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsMilestonesRequest;
use App\Http\Requests\UpdateSomProjectsMilestonesRequest;
use App\Repositories\SomProjectsMilestonesRepository;
use App\Repositories\SomProjectsPhasesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;

class SomProjectsMilestonesController extends AppBaseController
{
    /** @var  SomProjectsMilestonesRepository */
    private $somProjectsMilestonesRepository;
    private $somProjectsPhasesRepository;

    public function __construct(SomProjectsMilestonesRepository $somProjectsMilestonesRepo,
                                SomProjectsPhasesRepository $somProjectsPhasesRepo)
    {
        $this->somProjectsMilestonesRepository = $somProjectsMilestonesRepo;
        $this->somProjectsPhasesRepository = $somProjectsPhasesRepo;
    }

    /**
     * Display a listing of the SomProjectsMilestones.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $phases_id = $request->get('phases_id');
        // if(!empty($phases_id))
        //     $somProjectsMilestones = $this->somProjectsMilestonesRepository->all(['som_projects_phases_id'=>$phases_id]);
        // else
        //     $somProjectsMilestones = $this->somProjectsMilestonesRepository->all();

        $bradecrumbs = array();
        $bradecrumbs[0] = array();         
        $bradecrumbs[0]['id'] = 0;
        $bradecrumbs[0]['name'] = "";
        $bradecrumbs[1] = array();
        $bradecrumbs[1]['id'] = 0;
        $bradecrumbs[1]['name'] = "";

        if(!empty($phases_id)){
            $bradeAry = $this->somProjectsPhasesRepository->getBradecrumbsById($phases_id);          
                      
            $bradecrumbs[0]['id'] = $bradeAry[0]['som_projects_id'];
            $bradecrumbs[0]['name'] = $bradeAry[0]['som_projects_name'];            
            $bradecrumbs[1]['id'] = $phases_id;
            $bradecrumbs[1]['name'] = $bradeAry[0]['som_phases_name'];
        }

        if ($request->ajax()) {

            if(!empty($phases_id))
                $data = $this->somProjectsMilestonesRepository->all(['som_projects_phases_id'=>$phases_id]);
            else
                $data = $this->somProjectsMilestonesRepository->all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('due_date', function ($request) {
                    $due_date = "";
                    if(!empty($request->due_date)){
                        $due_date = date('Y-m-d', strtotime($request->due_date));
                    }
                    return $due_date; 
                })
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button Forms                    
                    $action .= "<a href=\"".route( "somForms.index", ['milestones_id'=> $row->id] )."\" class='btn btn-default btn-xs'><i class='fas fa-list' title='Forms'></i> Forms</a>";

                    //button show                
                    $action .= "<a href=\"".route('somProjectsMilestones.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somProjectsMilestones.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_projects_milestones.index')
                ->with('somProjectsPhaseId', $phases_id)
                ->with('bradecrumbs', $bradecrumbs);
    }

    /**
     * Show the form for creating a new SomProjectsMilestones.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $phases_id = $request->get('phases_id');
        return view('som_projects_milestones.create')
                ->with('somProjectsMilestones', array())
                ->with('somProjectsPhaseId', $phases_id);
    }

    /**
     * Store a newly created SomProjectsMilestones in storage.
     *
     * @param CreateSomProjectsMilestonesRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsMilestonesRequest $request)
    {
        $input = $request->all();

        $somProjectsMilestones = $this->somProjectsMilestonesRepository->create($input);

        Flash::success('Som Projects Milestones saved successfully.');

        $phases_id = $somProjectsMilestones->som_projects_phases_id;
        return redirect(route('somProjectsMilestones.index', ['phases_id'=>$phases_id]));
    }

    /**
     * Display the specified SomProjectsMilestones.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectsMilestones = $this->somProjectsMilestonesRepository->find($id);

        if (empty($somProjectsMilestones)) {
            Flash::error('Som Projects Milestones not found');

            return redirect(route('somProjectsMilestones.index'));
        }

        return view('som_projects_milestones.show')->with('somProjectsMilestones', $somProjectsMilestones);
    }

    /**
     * Show the form for editing the specified SomProjectsMilestones.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectsMilestones = $this->somProjectsMilestonesRepository->find($id);

        if (empty($somProjectsMilestones)) {
            Flash::error('Som Projects Milestones not found');

            return redirect(route('somProjectsMilestones.index'));
        }
        $phases_id = $somProjectsMilestones->som_projects_phases_id;
        return view('som_projects_milestones.edit')
                ->with('somProjectsPhaseId', $phases_id)
                ->with('somProjectsMilestones', $somProjectsMilestones);
    }

    /**
     * Update the specified SomProjectsMilestones in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsMilestonesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsMilestonesRequest $request)
    {
        $somProjectsMilestones = $this->somProjectsMilestonesRepository->find($id);

        if (empty($somProjectsMilestones)) {
            Flash::error('Som Projects Milestones not found');

            return redirect(route('somProjectsMilestones.index'));
        }

        $somProjectsMilestones = $this->somProjectsMilestonesRepository->update($request->all(), $id);

        Flash::success('Som Projects Milestones updated successfully.');

        $phases_id = $somProjectsMilestones->som_projects_phases_id;
        return redirect(route('somProjectsMilestones.index', ['phases_id'=>$phases_id]));
    }

    /**
     * Remove the specified SomProjectsMilestones from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsMilestones = $this->somProjectsMilestonesRepository->find($id);

        if (empty($somProjectsMilestones)) {
            Flash::error('Som Projects Milestones not found');

            return redirect(route('somProjectsMilestones.index'));
        }

        $this->somProjectsMilestonesRepository->delete($id);

        Flash::success('Som Projects Milestones deleted successfully.');

        $phases_id = $somProjectsMilestones->som_projects_phases_id;
        return redirect(route('somProjectsMilestones.index', ['phases_id'=>$phases_id]));
    }
}
