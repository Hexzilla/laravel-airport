<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomFormTasksRequest;
use App\Http\Requests\UpdateSomFormTasksRequest;
use App\Repositories\SomFormTasksRepository;
use App\Repositories\CmsPrivilegesRepository;
use App\Repositories\SomDepartmentsRepository;
use App\Repositories\CmsPrivilegesRolesRepository;
use App\Repositories\SomFormsRepository;
use App\Models\SomFormTasks;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;

class SomFormTasksController extends AppBaseController
{
    /** @var  SomFormTasksRepository */
    private $somFormTasksRepository;
    private $cmsPrivilegesRepository;
    private $somDepartmentsRepository;
    private $somFormsRepository;

    public function __construct(SomFormTasksRepository $somFormTasksRepo,
                                CmsPrivilegesRepository $cmsPrivilegesRepo,
                                SomDepartmentsRepository $somDepartmentsRepo,
                                CmsPrivilegesRolesRepository $cmsPrivilegesRolesRepo,
                                SomFormsRepository $somFormsRepo
            )
    {
        $this->somFormTasksRepository = $somFormTasksRepo;
        $this->cmsPrivilegesRepository = $cmsPrivilegesRepo;
        $this->somDepartmentsRepository = $somDepartmentsRepo;
        $this->cmsPrivilegesRolesRepo = $cmsPrivilegesRolesRepo;
        $this->somFormsRepository = $somFormsRepo;
    }

    /**
     * Display a listing of the SomFormTasks.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somforms_id = $request->get('somforms_id');
        // $somFormTasks = $this->somFormTasksRepository->all(['som_forms_id'=>$somforms_id]);

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

        if(!empty($somforms_id)){
            $bradeAry = $this->somFormsRepository->getbreadcrumbsById($somforms_id);

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
            $breadcrumbs[3]['id'] = $somforms_id;
            $breadcrumbs[3]['name'] = $bradeAry[0]['name'];
        }

        if ($request->ajax()) {

            $data = $this->somFormTasksRepository->all(['som_forms_id'=>$somforms_id]);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show
                    $action .= "<a href=\"".route('somFormTasks.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";

                    //button edit
                    $action .= "<a href=\"".route('somFormTasks.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_form_tasks.index')
            ->with('somforms_id', $somforms_id)
            ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomFormTasks.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $somforms_id = $request->get('somforms_id');
        $somFormTasks = new SomFormTasks();
        $somFormTasks->som_forms_id = $somforms_id;
        $somFormTasks->order = 1;
        $somFormTasks->som_status_id = 0;
        $arrType['-1'] = 'Please select a Type';
        $arrType = $arrType + config( 'constants.taskTypes');

        $arrRole = array();
        $arrRole[] = 'Please select a Privilege';
        $roleEditor = config('constants.UserPrivileges.Editor');
        $roleLegal = config('constants.UserPrivileges.Legal');
        $roleFinance = config('constants.UserPrivileges.Finance');
        $roleFilter = array($roleLegal, $roleFinance, $roleEditor);
        $RoleRows = $this->cmsPrivilegesRepository->find($roleFilter)->toArray();
        foreach($RoleRows as $row)
        {
            $arrRole[$row['id']] = $row['name'];
        }

        $arrDepart = array();
        $arrDepart[] = 'Please select a Department';
        $DepartRows = $this->somDepartmentsRepository->all([], null, null, ['id','name'])->toArray();
        foreach($DepartRows as $row)
        {
            $arrDepart[$row['id']] = $row['name'];
        }

        return view('som_form_tasks.create')
                ->with('somforms_id', $somforms_id)
                ->with('arrType', $arrType)
                ->with('arrRole', $arrRole )
                ->with('arrDepart', $arrDepart)
                ->with('somFormTasks', $somFormTasks );
    }

    /**
     * Store a newly created SomFormTasks in storage.
     *
     * @param CreateSomFormTasksRequest $request
     *
     * @return Response
     */
    public function store(CreateSomFormTasksRequest $request)
    {
        $input = $request->all();

        $somFormTasks = $this->somFormTasksRepository->create($input);

        Flash::success('Som Form Tasks saved successfully.');
        $somforms_id = $somFormTasks->som_forms_id;
        return redirect(route('somFormTasks.index', ['somforms_id'=>$somforms_id]));
    }

    /**
     * Display the specified SomFormTasks.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somFormTasks = $this->somFormTasksRepository->find($id);

        if (empty($somFormTasks)) {
            Flash::error('Som Form Tasks not found');

            return redirect(route('somFormTasks.index'));
        }

        $somforms_id = $somFormTasks->som_forms_id;
        return view('som_form_tasks.show')->with('somFormTasks', $somFormTasks);
    }

    /**
     * Show the form for editing the specified SomFormTasks.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somFormTasks = $this->somFormTasksRepository->find($id);

        if (empty($somFormTasks)) {
            Flash::error('Som Form Tasks not found');

            return redirect(route('somFormTasks.index'));
        }
        //get select Role items
        $arrRole = array();
        $arrRole[] = 'Please select a Privilege';
        $roleEditor = config('constants.UserPrivileges.Editor');
        $roleLegal = config('constants.UserPrivileges.Legal');
        $roleFinance = config('constants.UserPrivileges.Finance');
        $roleFilter = array($roleLegal, $roleFinance, $roleEditor);
        $RoleRows = $this->cmsPrivilegesRepository->find($roleFilter)->toArray();
        foreach($RoleRows as $row)
        {
            $arrRole[$row['id']] = $row['name'];
        }
        //get select Department items
        $arrDepart = array();
        $arrDepart[] = 'Please select a Department';
        $DepartRows = $this->somDepartmentsRepository->all([], null, null, ['id','name'])->toArray();
        foreach($DepartRows as $row)
        {
            $arrDepart[$row['id']] = $row['name'];
        }

        $arrType['-1'] = 'Please select a Type';
        $arrType = $arrType + config( 'constants.taskTypes');

        return view('som_form_tasks.edit')
            ->with('somFormTasks', $somFormTasks)
            ->with('arrType', $arrType)
            ->with('arrRole', $arrRole)
            ->with('arrDepart', $arrDepart);
    }

    /**
     * Update the specified SomFormTasks in storage.
     *
     * @param int $id
     * @param UpdateSomFormTasksRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomFormTasksRequest $request)
    {
        $somFormTasks = $this->somFormTasksRepository->find($id);

        if (empty($somFormTasks)) {
            Flash::error('Som Form Tasks not found');

            return redirect(route('somFormTasks.index'));
        }

        $somFormTasks = $this->somFormTasksRepository->update($request->all(), $id);

        Flash::success('Som Form Tasks updated successfully.');
        $somforms_id = $somFormTasks->som_forms_id;
        return redirect(route('somFormTasks.index', ['somforms_id'=>$somforms_id]));
    }

    /**
     * Remove the specified SomFormTasks from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somFormTasks = $this->somFormTasksRepository->find($id);

        if (empty($somFormTasks)) {
            Flash::error('Som Form Tasks not found');

            return redirect(route('somFormTasks.index'));
        }
        $somforms_id = $somFormTasks->som_forms_id;

        $this->somFormTasksRepository->delete($id);

        Flash::success('Som Form Tasks deleted successfully.');
        return redirect(route('somFormTasks.index', ['somforms_id'=>$somforms_id]));
    }
}
