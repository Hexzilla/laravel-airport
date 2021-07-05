<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsMenusRequest;
use App\Http\Requests\UpdateCmsMenusRequest;
use App\Repositories\CmsMenusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CmsMenusController extends AppBaseController
{
    /** @var  CmsMenusRepository */
    private $cmsMenusRepository;

    public function __construct(CmsMenusRepository $cmsMenusRepo)
    {
        $this->cmsMenusRepository = $cmsMenusRepo;
    }

    /**
     * Display a listing of the CmsMenus.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cmsMenuses = $this->cmsMenusRepository->all();

        return view('cms_menuses.index')
            ->with('cmsMenuses', $cmsMenuses);
    }

    /**
     * Show the form for creating a new CmsMenus.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_menuses.create');
    }

    /**
     * Store a newly created CmsMenus in storage.
     *
     * @param CreateCmsMenusRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsMenusRequest $request)
    {
        $input = $request->all();

        $cmsMenus = $this->cmsMenusRepository->create($input);

        Flash::success('Cms Menus saved successfully.');

        return redirect(route('cmsMenuses.index'));
    }

    /**
     * Display the specified CmsMenus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsMenus = $this->cmsMenusRepository->find($id);

        if (empty($cmsMenus)) {
            Flash::error('Cms Menus not found');

            return redirect(route('cmsMenuses.index'));
        }

        return view('cms_menuses.show')->with('cmsMenus', $cmsMenus);
    }

    /**
     * Show the form for editing the specified CmsMenus.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsMenus = $this->cmsMenusRepository->find($id);

        if (empty($cmsMenus)) {
            Flash::error('Cms Menus not found');

            return redirect(route('cmsMenuses.index'));
        }

        return view('cms_menuses.edit')->with('cmsMenus', $cmsMenus);
    }

    /**
     * Update the specified CmsMenus in storage.
     *
     * @param int $id
     * @param UpdateCmsMenusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsMenusRequest $request)
    {
        $cmsMenus = $this->cmsMenusRepository->find($id);

        if (empty($cmsMenus)) {
            Flash::error('Cms Menus not found');

            return redirect(route('cmsMenuses.index'));
        }

        $cmsMenus = $this->cmsMenusRepository->update($request->all(), $id);

        Flash::success('Cms Menus updated successfully.');

        return redirect(route('cmsMenuses.index'));
    }

    /**
     * Remove the specified CmsMenus from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsMenus = $this->cmsMenusRepository->find($id);

        if (empty($cmsMenus)) {
            Flash::error('Cms Menus not found');

            return redirect(route('cmsMenuses.index'));
        }

        $this->cmsMenusRepository->delete($id);

        Flash::success('Cms Menus deleted successfully.');

        return redirect(route('cmsMenuses.index'));
    }
}
