<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomFormElementsRequest;
use App\Http\Requests\UpdateSomFormElementsRequest;
use App\Repositories\SomFormElementsRepository;
use App\Repositories\CmsPrivilegesRolesRepository;
use App\Repositories\cmsPrivilegesRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\SomFormElements;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomFormElementsController extends AppBaseController
{
    /** @var  SomFormElementsRepository */
    private $somFormElementsRepository;

     /** @var  CmsPrivilegesRolesRepository */
     private $cmsPrivilegesRolesRepository;
    private $cmsPrivilegesRepository;

    public function __construct(
            SomFormElementsRepository $somFormElementsRepo, 
            CmsPrivilegesRolesRepository $cmsPrivilegesRolesRepo,
            cmsPrivilegesRepository $cmsPrivilegesRepo)
    {
        $this->somFormElementsRepository = $somFormElementsRepo;
        $this->cmsPrivilegesRolesRepository = $cmsPrivilegesRolesRepo;
        $this->cmsPrivilegesRepository = $cmsPrivilegesRepo;
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
        $somFormElements = $this->somFormElementsRepository->all(['som_forms_id'=>$somforms_id]);

        return view('som_form_elements.index')
            ->with('somforms_id', $somforms_id)
            ->with('somFormElements', $somFormElements);
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
        // $DepartRows = $this->somDepartmentsRepository->all([], null, null, ['id','name'])->toArray();
        // foreach($DepartRows as $row)
        // {
        //     $arrDepart[$row['id']] = $row['name'];
        // }

        $elementTypes[] = 'Please select a Element type';
        $elementTypes = $elementTypes + config('constants.elementTypes');
        return view('som_form_elements.create')
                ->with('somforms_id', $somforms_id)
                ->with('arrType', $arrType)
                ->with('arrRole', $arrRole )
                ->with('arrDepart', $arrDepart)
                ->with('elementTypes', $elementTypes)
                ->with('selectedRolId', 0)
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
        $somFormElementsArray = $somFormElements->toArray();
        $selectedRolId = $somFormElementsArray['cms_privileges_role_id'];

        $cmsPrivilegesRoles  = array();
        $cmsPrivilegesRoles= $this->cmsPrivilegesRolesRepository->all();
        $rolIds[] = '**Please Select a Cms Privileges Role';
        foreach($cmsPrivilegesRoles->toArray() as $rows)
        {
            $rolIds[$rows['id']] = $rows['id'];
        }

        $elementTypes[] = '**Please Select a Element type';
        $elementTypes = $elementTypes + config('constants.elementTypes');

        return view('som_form_elements.edit')
            ->with('somforms_id', $somforms_id)
            ->with('somFormElements', $somFormElements)
            ->with('elementTypes', $elementTypes)
            ->with('arrRole', $rolIds)
            ->with('selectedRolId', $selectedRolId);
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
