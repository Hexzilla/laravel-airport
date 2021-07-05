<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsModulsRequest;
use App\Http\Requests\UpdateCmsModulsRequest;
use App\Repositories\CmsModulsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CmsModulsController extends AppBaseController
{
    /** @var  CmsModulsRepository */
    private $cmsModulsRepository;

    public function __construct(CmsModulsRepository $cmsModulsRepo)
    {
        $this->cmsModulsRepository = $cmsModulsRepo;
    }

    /**
     * Display a listing of the CmsModuls.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $cmsModuls = $this->cmsModulsRepository->all();

        return view('cms_moduls.index')
            ->with('cmsModuls', $cmsModuls);
    }

    /**
     * Show the form for creating a new CmsModuls.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_moduls.create');
    }

    /**
     * Store a newly created CmsModuls in storage.
     *
     * @param CreateCmsModulsRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsModulsRequest $request)
    {
        $input = $request->all();

        $cmsModuls = $this->cmsModulsRepository->create($input);

        Flash::success('Cms Moduls saved successfully.');

        return redirect(route('cmsModuls.index'));
    }

    /**
     * Display the specified CmsModuls.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsModuls = $this->cmsModulsRepository->find($id);

        if (empty($cmsModuls)) {
            Flash::error('Cms Moduls not found');

            return redirect(route('cmsModuls.index'));
        }

        return view('cms_moduls.show')->with('cmsModuls', $cmsModuls);
    }

    /**
     * Show the form for editing the specified CmsModuls.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsModuls = $this->cmsModulsRepository->find($id);

        if (empty($cmsModuls)) {
            Flash::error('Cms Moduls not found');

            return redirect(route('cmsModuls.index'));
        }

        return view('cms_moduls.edit')->with('cmsModuls', $cmsModuls);
    }

    /**
     * Update the specified CmsModuls in storage.
     *
     * @param int $id
     * @param UpdateCmsModulsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsModulsRequest $request)
    {
        $cmsModuls = $this->cmsModulsRepository->find($id);

        if (empty($cmsModuls)) {
            Flash::error('Cms Moduls not found');

            return redirect(route('cmsModuls.index'));
        }

        $cmsModuls = $this->cmsModulsRepository->update($request->all(), $id);

        Flash::success('Cms Moduls updated successfully.');

        return redirect(route('cmsModuls.index'));
    }

    /**
     * Remove the specified CmsModuls from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsModuls = $this->cmsModulsRepository->find($id);

        if (empty($cmsModuls)) {
            Flash::error('Cms Moduls not found');

            return redirect(route('cmsModuls.index'));
        }

        $this->cmsModulsRepository->delete($id);

        Flash::success('Cms Moduls deleted successfully.');

        return redirect(route('cmsModuls.index'));
    }
}
