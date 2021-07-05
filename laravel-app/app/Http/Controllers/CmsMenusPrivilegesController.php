<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsMenusPrivilegesRequest;
use App\Http\Requests\UpdateCmsMenusPrivilegesRequest;
use App\Repositories\CmsMenusPrivilegesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CmsMenusPrivilegesController extends AppBaseController
{
    /** @var  CmsMenusPrivilegesRepository */
    private $cmsMenusPrivilegesRepository;

    public function __construct(CmsMenusPrivilegesRepository $cmsMenusPrivilegesRepo)
    {
        $this->cmsMenusPrivilegesRepository = $cmsMenusPrivilegesRepo;
    }

    /**
     * Display a listing of the CmsMenusPrivileges.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cmsMenusPrivileges = $this->cmsMenusPrivilegesRepository->all();

        return view('cms_menus_privileges.index')
            ->with('cmsMenusPrivileges', $cmsMenusPrivileges);
    }

    /**
     * Show the form for creating a new CmsMenusPrivileges.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_menus_privileges.create');
    }

    /**
     * Store a newly created CmsMenusPrivileges in storage.
     *
     * @param CreateCmsMenusPrivilegesRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsMenusPrivilegesRequest $request)
    {
        $input = $request->all();

        $cmsMenusPrivileges = $this->cmsMenusPrivilegesRepository->create($input);

        Flash::success('Cms Menus Privileges saved successfully.');

        return redirect(route('cmsMenusPrivileges.index'));
    }

    /**
     * Display the specified CmsMenusPrivileges.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsMenusPrivileges = $this->cmsMenusPrivilegesRepository->find($id);

        if (empty($cmsMenusPrivileges)) {
            Flash::error('Cms Menus Privileges not found');

            return redirect(route('cmsMenusPrivileges.index'));
        }

        return view('cms_menus_privileges.show')->with('cmsMenusPrivileges', $cmsMenusPrivileges);
    }

    /**
     * Show the form for editing the specified CmsMenusPrivileges.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsMenusPrivileges = $this->cmsMenusPrivilegesRepository->find($id);

        if (empty($cmsMenusPrivileges)) {
            Flash::error('Cms Menus Privileges not found');

            return redirect(route('cmsMenusPrivileges.index'));
        }

        return view('cms_menus_privileges.edit')->with('cmsMenusPrivileges', $cmsMenusPrivileges);
    }

    /**
     * Update the specified CmsMenusPrivileges in storage.
     *
     * @param int $id
     * @param UpdateCmsMenusPrivilegesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsMenusPrivilegesRequest $request)
    {
        $cmsMenusPrivileges = $this->cmsMenusPrivilegesRepository->find($id);

        if (empty($cmsMenusPrivileges)) {
            Flash::error('Cms Menus Privileges not found');

            return redirect(route('cmsMenusPrivileges.index'));
        }

        $cmsMenusPrivileges = $this->cmsMenusPrivilegesRepository->update($request->all(), $id);

        Flash::success('Cms Menus Privileges updated successfully.');

        return redirect(route('cmsMenusPrivileges.index'));
    }

    /**
     * Remove the specified CmsMenusPrivileges from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsMenusPrivileges = $this->cmsMenusPrivilegesRepository->find($id);

        if (empty($cmsMenusPrivileges)) {
            Flash::error('Cms Menus Privileges not found');

            return redirect(route('cmsMenusPrivileges.index'));
        }

        $this->cmsMenusPrivilegesRepository->delete($id);

        Flash::success('Cms Menus Privileges deleted successfully.');

        return redirect(route('cmsMenusPrivileges.index'));
    }
}
