<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomFormElementsRequest;
use App\Http\Requests\UpdateSomFormElementsRequest;
use App\Repositories\SomFormElementsRepository;
use App\Repositories\CmsPrivilegesRolesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomFormElementsController extends AppBaseController
{
    /** @var  SomFormElementsRepository */
    private $somFormElementsRepository;

     /** @var  CmsPrivilegesRolesRepository */
     private $cmsPrivilegesRolesRepository;



    public function __construct(SomFormElementsRepository $somFormElementsRepo, CmsPrivilegesRolesRepository $cmsPrivilegesRolesRepo)
    {
        $this->somFormElementsRepository = $somFormElementsRepo;
        $this->cmsPrivilegesRolesRepository = $cmsPrivilegesRolesRepo;
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
        $somFormElements = $this->somFormElementsRepository->all();

        return view('som_form_elements.index')
            ->with('somFormElements', $somFormElements);
    }

    /**
     * Show the form for creating a new SomFormElements.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_form_elements.create');
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

        return redirect(route('somFormElements.index'));
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

        $somFormElementsArray = $somFormElements->toArray();
        $selectedRolId = $somFormElementsArray['cms_privileges_role_id'];

        $cmsPrivilegesRoles= $this->cmsPrivilegesRolesRepository->all();
        
        $rolIds = array('' => '**Please Select a Cms Privileges Role');
        foreach($cmsPrivilegesRoles->toArray() as $rows)
        {
            $rolIds[$rows['id']] = $rows['id'];
        }

        $elementTypes = config('constants.elementTypes');

        return view('som_form_elements.edit')->with('somFormElements', $somFormElements)
        ->with('elementTypes', $elementTypes)
        ->with('cmsPrivilegesRoles', $rolIds)
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

        return redirect(route('somFormElements.index'));
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

        $this->somFormElementsRepository->delete($id);

        Flash::success('Som Form Elements deleted successfully.');

        return redirect(route('somFormElements.index'));
    }
}
