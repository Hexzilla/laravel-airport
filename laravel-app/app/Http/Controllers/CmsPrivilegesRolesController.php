<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsPrivilegesRolesRequest;
use App\Http\Requests\UpdateCmsPrivilegesRolesRequest;
use App\Repositories\CmsPrivilegesRolesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CmsPrivilegesRolesController extends AppBaseController
{
    /** @var  CmsPrivilegesRolesRepository */
    private $cmsPrivilegesRolesRepository;

    public function __construct(CmsPrivilegesRolesRepository $cmsPrivilegesRolesRepo)
    {
        $this->cmsPrivilegesRolesRepository = $cmsPrivilegesRolesRepo;
    }

    /**
     * Display a listing of the CmsPrivilegesRoles.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cmsPrivilegesRoles = $this->cmsPrivilegesRolesRepository->all();

        return view('cms_privileges_roles.index')
            ->with('cmsPrivilegesRoles', $cmsPrivilegesRoles);
    }

    /**
     * Show the form for creating a new CmsPrivilegesRoles.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_privileges_roles.create');
    }

    /**
     * Store a newly created CmsPrivilegesRoles in storage.
     *
     * @param CreateCmsPrivilegesRolesRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsPrivilegesRolesRequest $request)
    {
        $input = $request->all();

        $cmsPrivilegesRoles = $this->cmsPrivilegesRolesRepository->create($input);

        Flash::success('Cms Privileges Roles saved successfully.');

        return redirect(route('cmsPrivilegesRoles.index'));
    }

    /**
     * Display the specified CmsPrivilegesRoles.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsPrivilegesRoles = $this->cmsPrivilegesRolesRepository->find($id);

        if (empty($cmsPrivilegesRoles)) {
            Flash::error('Cms Privileges Roles not found');

            return redirect(route('cmsPrivilegesRoles.index'));
        }

        return view('cms_privileges_roles.show')->with('cmsPrivilegesRoles', $cmsPrivilegesRoles);
    }

    /**
     * Show the form for editing the specified CmsPrivilegesRoles.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsPrivilegesRoles = $this->cmsPrivilegesRolesRepository->find($id);

        if (empty($cmsPrivilegesRoles)) {
            Flash::error('Cms Privileges Roles not found');

            return redirect(route('cmsPrivilegesRoles.index'));
        }

        return view('cms_privileges_roles.edit')->with('cmsPrivilegesRoles', $cmsPrivilegesRoles);
    }

    /**
     * Update the specified CmsPrivilegesRoles in storage.
     *
     * @param int $id
     * @param UpdateCmsPrivilegesRolesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsPrivilegesRolesRequest $request)
    {
        $cmsPrivilegesRoles = $this->cmsPrivilegesRolesRepository->find($id);

        if (empty($cmsPrivilegesRoles)) {
            Flash::error('Cms Privileges Roles not found');

            return redirect(route('cmsPrivilegesRoles.index'));
        }

        $cmsPrivilegesRoles = $this->cmsPrivilegesRolesRepository->update($request->all(), $id);

        Flash::success('Cms Privileges Roles updated successfully.');

        return redirect(route('cmsPrivilegesRoles.index'));
    }

    /**
     * Remove the specified CmsPrivilegesRoles from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsPrivilegesRoles = $this->cmsPrivilegesRolesRepository->find($id);

        if (empty($cmsPrivilegesRoles)) {
            Flash::error('Cms Privileges Roles not found');

            return redirect(route('cmsPrivilegesRoles.index'));
        }

        $this->cmsPrivilegesRolesRepository->delete($id);

        Flash::success('Cms Privileges Roles deleted successfully.');

        return redirect(route('cmsPrivilegesRoles.index'));
    }
}
