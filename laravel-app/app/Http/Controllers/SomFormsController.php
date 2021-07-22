<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomFormsRequest;
use App\Http\Requests\UpdateSomFormsRequest;
use App\Repositories\SomFormsRepository;
use App\Repositories\SomProjectsMilestonesRepository;
use App\Models\SomForms;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;

class SomFormsController extends AppBaseController
{
    /** @var  SomFormsRepository */
    private $somFormsRepository;
    private $somProjectsMilestonesRepository;

    public function __construct(SomFormsRepository $somFormsRepo,
                                SomProjectsMilestonesRepository $somProjectsMilestonesRepo)
    {
        $this->somFormsRepository = $somFormsRepo;
        $this->somProjectsMilestonesRepository = $somProjectsMilestonesRepo;
    }

    /**
     * Display a listing of the SomForms.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $milestones_id = $request->get('milestones_id');
            
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

        if(!empty($milestones_id)){
            $bradeAry = $this->somProjectsMilestonesRepository->getbreadcrumbsById($milestones_id);          
               
            //projects        
            $breadcrumbs[0]['id'] = $bradeAry[0]['som_projects_id'];            
            $breadcrumbs[0]['name'] = $bradeAry[0]['som_projects_name'];
            //phases            
            $breadcrumbs[1]['id'] = $bradeAry[0]['som_projects_phases_id'];
            $breadcrumbs[1]['name'] = $bradeAry[0]['som_phases_name'];
            //milestones 
            $breadcrumbs[2]['id'] = $milestones_id;
            $breadcrumbs[2]['name'] = $bradeAry[0]['name']; 
        }

        if ($request->ajax()) {

            if( !empty($milestones_id) ){
                $data = $this->somFormsRepository->all(['som_phases_milestones_id'=>$milestones_id]);
            }
            else{
                $data = $this->somFormsRepository->all();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($request) {
                    return '<input type="checkbox" class="sub_chk" id="'.$request->id.'" name="someCheckbox" />';
                })
                ->editColumn('is_inactive', function ($request) {
                    $html = "";
                    if(!empty($request->is_inactive)){
                        $html = $request->is_inactive;
                    }
                    return $html; 
                })
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button tasks
                    $action .= "<a href=\"".route('somFormTasks.index', ['somforms_id'=>$row->id])."\" class='btn btn-default btn-xs'>
                        <i class='far fa-task'></i>tasks</a>";

                    //button elements
                    $action .= "<a href=\"".route('somFormElements.index', ['somforms_id'=>$row->id])."\" class='btn btn-default btn-xs'>
                        <i class='far fa-task'></i>elements</a>";

                    //button approvals
                    $action .= "<a href=\"".route('somFormApprovals.index', ['somforms_id'=>$row->id])."\" class='btn btn-default btn-xs'>
                        <i class='far fa-task'></i>approvals</a>";

                    //button show                
                    // $action .= "<a href=\"".route('somForms.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    // $action .= "<i class='far fa-eye'></i>";
                    // $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somForms.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-edit'></i>";

                    //button delete
                    // $action .= "</a>";
                    // $action .= "<button class='btn btn-danger btn-xs' onclick='openDeleteModal(\"".$row->id."\")'><i class='far fa-trash-alt'></i></button>";

                    $action .= "</div>";
                    return $action;                        
                })                    
                ->rawColumns(['checkbox','action'])                
                ->make(true);
        }

        return view('som_forms.index')
                ->with('milestones_id', $milestones_id)
                ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomForms.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $somForm = new SomForms(); 
        $milestones_id = $request->get('milestones_id');
        $somForm->active = 1;
        $somForm->order_form = 1;
        $somForm->som_milestones_forms_types_id = 1;
        $somForm->som_phases_milestones_id = $milestones_id;
        return view('som_forms.create')
                ->with('milestones_id', $milestones_id)
                ->with('somForms', $somForm);
    }

    /**
     * Store a newly created SomForms in storage.
     *
     * @param CreateSomFormsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomFormsRequest $request)
    {
        $input = $request->all();

        $somForms = $this->somFormsRepository->create($input);

        Flash::success('Som Forms saved successfully.');
        $milestones_id = $somForms->som_phases_milestones_id;
        return redirect(route('somForms.index',['milestones_id'=> $milestones_id]));
    }

    /**
     * Display the specified SomForms.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somForms = $this->somFormsRepository->find($id);

        if (empty($somForms)) {
            Flash::error('Som Forms not found');

            return redirect(route('somForms.index'));
        }
        $milestones_id = $somForms->som_phases_milestones_id;
        return view('som_forms.show')
                ->with('milestones_id', $milestones_id)
                ->with('somForms', $somForms);
    }

    /**
     * Show the form for editing the specified SomForms.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somForms = $this->somFormsRepository->find($id);

        if (empty($somForms)) {
            Flash::error('Som Forms not found');

            return redirect(route('somForms.index'));
        }
        $milestones_id =  $somForms->som_phases_milestones_id;
        return view('som_forms.edit')
                ->with('milestones_id', $milestones_id )
                ->with('somForms', $somForms);
    }

    /**
     * Update the specified SomForms in storage.
     *
     * @param int $id
     * @param UpdateSomFormsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomFormsRequest $request)
    {
        $somForms = $this->somFormsRepository->find($id);

        if (empty($somForms)) {
            Flash::error('Som Forms not found');

            return redirect(route('somForms.index'));
        }

        $somForms = $this->somFormsRepository->update($request->all(), $id);
        $milestones_id =  $somForms->som_phases_milestones_id;
        Flash::success('Som Forms updated successfully.');

        return redirect(route('somForms.index', ['milestones_id'=>$milestones_id ]));
    }

    /**
     * Remove the specified SomForms from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somForms = $this->somFormsRepository->find($id);

        if (empty($somForms)) {
            Flash::error('Som Forms not found');

            return redirect(route('somForms.index'));
        }
        $milestones_id =  $somForms->som_phases_milestones_id;
        $this->somFormsRepository->delete($id);

        Flash::success('Som Forms deleted successfully.');
        
        return redirect(route('somForms.index', ['milestones_id'=>$milestones_id]));
    }

    /**
     * Remove selected items from storage.
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        $data_id_array = explode(",", $ids); 
        if(!empty($data_id_array)) {
            foreach($data_id_array as $id) {
                $this->somFormsRepository->delete($id);
            }
        }
        return response()->json(['success'=>"Deleted successfully."]);
    }
}
