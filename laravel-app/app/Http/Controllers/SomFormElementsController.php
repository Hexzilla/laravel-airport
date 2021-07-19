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

        $bradecrumbs = array();
        $bradecrumbs[0] = array();         
        $bradecrumbs[0]['id'] = 0;
        $bradecrumbs[0]['name'] = "";
        $bradecrumbs[1] = array();
        $bradecrumbs[1]['id'] = 0;
        $bradecrumbs[1]['name'] = "";
        $bradecrumbs[2] = array();
        $bradecrumbs[2]['id'] = 0;
        $bradecrumbs[2]['name'] = "";
        $bradecrumbs[3] = array();
        $bradecrumbs[3]['id'] = 0;
        $bradecrumbs[3]['name'] = "";

        if(!empty($somforms_id)){
            $bradeAry = $this->somFormsRepository->getBradecrumbsById($somforms_id); 

            //projects        
            $bradecrumbs[0]['id'] = $bradeAry[0]['som_projects_id'];            
            $bradecrumbs[0]['name'] = $bradeAry[0]['som_projects_name'];
            //phases            
            $bradecrumbs[1]['id'] = $bradeAry[0]['som_projects_phases_id'];
            $bradecrumbs[1]['name'] = $bradeAry[0]['som_phases_name'];
            //milestones 
            $bradecrumbs[2]['id'] = $bradeAry[0]['som_phases_milestones_id']; 
            $bradecrumbs[2]['name'] = $bradeAry[0]['som_phases_milestones_name']; 
            //forms
            $bradecrumbs[3]['id'] = $somforms_id; 
            $bradecrumbs[3]['name'] = $bradeAry[0]['name'];
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
        }

        return view('som_form_elements.index')
            ->with('somforms_id', $somforms_id)
            ->with('bradecrumbs', $bradecrumbs);
    }

    /**
     * Show the form for creating a new SomFormElements.
     *
     * @return Response
     */
    public function create(Request $request)
    {
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
        $input = $request->all();

        $somFormElements = $this->somFormElementsRepository->create($input);

        Flash::success('Som Form Elements saved successfully.');
        $somforms_id = $somFormElements->som_forms_id;
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
        $somFormElements = $this->somFormElementsRepository->find($id);

        if (empty($somFormElements)) {
            Flash::error('Som Form Elements not found');

            return redirect(route('somFormElements.index'));
        }

        $somforms_id = $somFormElements->som_forms_id;
        return view('som_form_elements.show')->with('somFormElements', $somFormElements);
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
            ->with('arrRole', $RoleRows);
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
        $somFormElements = $this->somFormElementsRepository->find($id);

        if (empty($somFormElements)) {
            Flash::error('Som Form Elements not found');

            return redirect(route('somFormElements.index'));
        }

        $somFormElements = $this->somFormElementsRepository->update($request->all(), $id);

        Flash::success('Som Form Elements updated successfully.');
        $somforms_id = $somFormElements->som_forms_id;
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
        $somFormElements = $this->somFormElementsRepository->find($id);

        if (empty($somFormElements)) {
            Flash::error('Som Form Elements not found');

            return redirect(route('somFormElements.index'));
        }
        $somforms_id = $somFormElements->som_forms_id;

        $this->somFormElementsRepository->delete($id);

        Flash::success('Som Form Elements deleted successfully.');

        return redirect(route('somFormElements.index', ['somforms_id'=>$somforms_id]));
    }
}
