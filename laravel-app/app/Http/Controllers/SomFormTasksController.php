<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomFormTasksRequest;
use App\Http\Requests\UpdateSomFormTasksRequest;
use App\Repositories\SomFormTasksRepository;
use App\Repositories\CmsPrivilegesRepository;
use App\Repositories\SomDepartmentsRepository;
use App\Repositories\CmsPrivilegesRolesRepository;
use App\Models\SomFormTasks;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Response;

class SomFormTasksController extends AppBaseController
{
    /** @var  SomFormTasksRepository */
    private $somFormTasksRepository;
    private $cmsPrivilegesRepository;
    private $somDepartmentsRepository;

    public function __construct(SomFormTasksRepository $somFormTasksRepo,
                                CmsPrivilegesRepository $cmsPrivilegesRepo,
                                SomDepartmentsRepository $somDepartmentsRepo,
                                CmsPrivilegesRolesRepository $cmsPrivilegesRolesRepo
            )
    {
        $this->somFormTasksRepository = $somFormTasksRepo;
        $this->cmsPrivilegesRepository = $cmsPrivilegesRepo;
        $this->somDepartmentsRepository = $somDepartmentsRepo;
        $this->cmsPrivilegesRolesRepo = $cmsPrivilegesRolesRepo;
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
        $somFormTasks = $this->somFormTasksRepository->all(['som_forms_id'=>$somforms_id]);
        return view('som_form_tasks.index')
            ->with('somforms_id', $somforms_id)
            ->with('somFormTasks', $somFormTasks);
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
        $arrType[] = 'Please select a Type';
        $arrType = $arrType + config( 'constants.taskTypes');
        
        $arrRole = array();
        $arrRole[] = 'Please select a Privilege';
        $RoleRows = $this->cmsPrivilegesRepository->all([], null, null, ['id', 'name'])->toArray();
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
        $items = $this->cmsPrivilegesRepository->all([], null, null, ['id', 'name'])->toArray();
        $role = Arr::pluck($items,'name','id');

        //get select Department items
        $DepartItems = $this->somDepartmentsRepository->all([], null, null, ['id', 'name'])->toArray();
        $arrDepart = Arr::pluck($DepartItems,'name','id');

        $arrType = config( 'constants.taskTypes');

        return view('som_form_tasks.edit')
            ->with('somFormTasks', $somFormTasks)
            ->with('arrType', $arrType)
            ->with('arrRole', $role)
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
