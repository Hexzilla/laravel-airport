<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsPrivilegesRequest;
use App\Http\Requests\UpdateCmsPrivilegesRequest;
use App\Repositories\CmsPrivilegesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CmsPrivilegesController extends AppBaseController
{
    /** @var  CmsPrivilegesRepository */
    private $cmsPrivilegesRepository;

    public function __construct(CmsPrivilegesRepository $cmsPrivilegesRepo)
    {
        $this->cmsPrivilegesRepository = $cmsPrivilegesRepo;
    }

    /**
     * Display a listing of the CmsPrivileges.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cmsPrivileges = $this->cmsPrivilegesRepository->all();

        return view('cms_privileges.index')
            ->with('cmsPrivileges', $cmsPrivileges);
    }

    /**
     * Show the form for creating a new CmsPrivileges.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_privileges.create');
    }

    /**
     * Store a newly created CmsPrivileges in storage.
     *
     * @param CreateCmsPrivilegesRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsPrivilegesRequest $request)
    {
        $input = $request->all();

        $cmsPrivileges = $this->cmsPrivilegesRepository->create($input);

        Flash::success('Cms Privileges saved successfully.');

        return redirect(route('cmsPrivileges.index'));
    }

    /**
     * Display the specified CmsPrivileges.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsPrivileges = $this->cmsPrivilegesRepository->find($id);

        if (empty($cmsPrivileges)) {
            Flash::error('Cms Privileges not found');

            return redirect(route('cmsPrivileges.index'));
        }

        return view('cms_privileges.show')->with('cmsPrivileges', $cmsPrivileges);
    }

    /**
     * Show the form for editing the specified CmsPrivileges.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsPrivileges = $this->cmsPrivilegesRepository->find($id);

        if (empty($cmsPrivileges)) {
            Flash::error('Cms Privileges not found');

            return redirect(route('cmsPrivileges.index'));
        }

        return view('cms_privileges.edit')->with('cmsPrivileges', $cmsPrivileges);
    }

    /**
     * Update the specified CmsPrivileges in storage.
     *
     * @param int $id
     * @param UpdateCmsPrivilegesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsPrivilegesRequest $request)
    {
        $cmsPrivileges = $this->cmsPrivilegesRepository->find($id);

        if (empty($cmsPrivileges)) {
            Flash::error('Cms Privileges not found');

            return redirect(route('cmsPrivileges.index'));
        }

        $cmsPrivileges = $this->cmsPrivilegesRepository->update($request->all(), $id);

        Flash::success('Cms Privileges updated successfully.');

        return redirect(route('cmsPrivileges.index'));
    }

    /**
     * Remove the specified CmsPrivileges from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsPrivileges = $this->cmsPrivilegesRepository->find($id);

        if (empty($cmsPrivileges)) {
            Flash::error('Cms Privileges not found');

            return redirect(route('cmsPrivileges.index'));
        }

        $this->cmsPrivilegesRepository->delete($id);

        Flash::success('Cms Privileges deleted successfully.');

        return redirect(route('cmsPrivileges.index'));
    }
}
