<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsPartnersRequest;
use App\Http\Requests\UpdateSomProjectsPartnersRequest;
use App\Repositories\SomProjectsPartnersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectsPartnersController extends AppBaseController
{
    /** @var  SomProjectsPartnersRepository */
    private $somProjectsPartnersRepository;

    public function __construct(SomProjectsPartnersRepository $somProjectsPartnersRepo)
    {
        $this->somProjectsPartnersRepository = $somProjectsPartnersRepo;
    }

    /**
     * Display a listing of the SomProjectsPartners.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somProjectsID = $request->input('project_id');  //0712
        $somProjectsPartners = $this->somProjectsPartnersRepository->all();

        return view('som_projects_partners.index')
            ->with('somProjectsPartners', $somProjectsPartners)
            ->with('somProjectID',$somProjectsID);  //0712
    }

    /**
     * Show the form for creating a new SomProjectsPartners.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return view('som_projects_partners.create')->with('somProjectID', $request->input('som_project_id'));
    }
    /**
     * Store a newly created SomProjectsPartners in storage.
     *
     * @param CreateSomProjectsPartnersRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsPartnersRequest $request)
    {
        $input = $request->all();

        $somProjectsPartners = $this->somProjectsPartnersRepository->create($input);

        Flash::success('Som Projects Partners saved successfully.');

        return redirect(route('somProjectsPartners.index'));
    }

    /**
     * Display the specified SomProjectsPartners.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectsPartners = $this->somProjectsPartnersRepository->find($id);

        if (empty($somProjectsPartners)) {
            Flash::error('Som Projects Partners not found');

            return redirect(route('somProjectsPartners.index'));
        }

        return view('som_projects_partners.show')->with('somProjectsPartners', $somProjectsPartners);
    }

    /**
     * Show the form for editing the specified SomProjectsPartners.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectsPartners = $this->somProjectsPartnersRepository->find($id);

        if (empty($somProjectsPartners)) {
            Flash::error('Som Projects Partners not found');

            return redirect(route('somProjectsPartners.index'));
        }

        return view('som_projects_partners.edit')
            ->with('somProjectsPartners', $somProjectsPartners)
            ->with('somProjectID', $somProjectsPartners->som_porjects_id); //0712
    }

    /**
     * Update the specified SomProjectsPartners in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsPartnersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsPartnersRequest $request)
    {
        $somProjectsPartners = $this->somProjectsPartnersRepository->find($id);

        if (empty($somProjectsPartners)) {
            Flash::error('Som Projects Partners not found');

            return redirect(route('somProjectsPartners.index'));
        }

        $somProjectsPartners = $this->somProjectsPartnersRepository->update($request->all(), $id);

        Flash::success('Som Projects Partners updated successfully.');

        return redirect(route('somProjectsPartners.index'));
    }

    /**
     * Remove the specified SomProjectsPartners from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsPartners = $this->somProjectsPartnersRepository->find($id);

        if (empty($somProjectsPartners)) {
            Flash::error('Som Projects Partners not found');

            return redirect(route('somProjectsPartners.index'));
        }

        $this->somProjectsPartnersRepository->delete($id);

        Flash::success('Som Projects Partners deleted successfully.');

        return redirect(route('somProjectsPartners.index'));
    }
}
