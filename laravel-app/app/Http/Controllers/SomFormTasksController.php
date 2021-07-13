<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomFormTasksRequest;
use App\Http\Requests\UpdateSomFormTasksRequest;
use App\Repositories\SomFormTasksRepository;
use App\Repositories\CmsPrivilegesRepository;
use App\Repositories\SomDepartmentsRepository;
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
                                SomDepartmentsRepository $somDepartmentsRepo

            )
    {
        $this->somFormTasksRepository = $somFormTasksRepo;
        $this->cmsPrivilegesRepository = $cmsPrivilegesRepo;
        $this->somDepartmentsRepository = $somDepartmentsRepo;
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
        $somFormTasks = $this->somFormTasksRepository->all();

        return view('som_form_tasks.index')
            ->with('somFormTasks', $somFormTasks);
    }

    /**
     * Show the form for creating a new SomFormTasks.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_form_tasks.create');
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

        return redirect(route('somFormTasks.index'));
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

        return redirect(route('somFormTasks.index'));
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

        $this->somFormTasksRepository->delete($id);

        Flash::success('Som Form Tasks deleted successfully.');

        return redirect(route('somFormTasks.index'));
    }
}
