<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsRequest;
use App\Http\Requests\UpdateSomProjectsRequest;
use App\Repositories\SomProjectsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectsController extends AppBaseController
{
    /** @var  SomProjectsRepository */
    private $somProjectsRepository;

    public function __construct(SomProjectsRepository $somProjectsRepo)
    {
        $this->somProjectsRepository = $somProjectsRepo;
    }

    /**
     * Display a listing of the SomProjects.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somProjects = $this->somProjectsRepository->all();

        return view('som_projects.index')
            ->with('somProjects', $somProjects);
    }

    /**
     * Show the form for creating a new SomProjects.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_projects.create');
    }

    /**
     * Store a newly created SomProjects in storage.
     *
     * @param CreateSomProjectsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsRequest $request)
    {
        $input = $request->all();

        $somProjects = $this->somProjectsRepository->create($input);

        Flash::success('Som Projects saved successfully.');

        return redirect(route('somProjects.index'));
    }

    /**
     * Display the specified SomProjects.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjects = $this->somProjectsRepository->find($id);

        if (empty($somProjects)) {
            Flash::error('Som Projects not found');

            return redirect(route('somProjects.index'));
        }

        return view('som_projects.show')->with('somProjects', $somProjects);
    }

    /**
     * Show the form for editing the specified SomProjects.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjects = $this->somProjectsRepository->find($id);

        if (empty($somProjects)) {
            Flash::error('Som Projects not found');

            return redirect(route('somProjects.index'));
        }

        return view('som_projects.edit')->with('somProjects', $somProjects);
    }

    /**
     * Update the specified SomProjects in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsRequest $request)
    {
        $somProjects = $this->somProjectsRepository->find($id);

        if (empty($somProjects)) {
            Flash::error('Som Projects not found');

            return redirect(route('somProjects.index'));
        }

        $somProjects = $this->somProjectsRepository->update($request->all(), $id);

        Flash::success('Som Projects updated successfully.');

        return redirect(route('somProjects.index'));
    }

    /**
     * Remove the specified SomProjects from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjects = $this->somProjectsRepository->find($id);

        if (empty($somProjects)) {
            Flash::error('Som Projects not found');

            return redirect(route('somProjects.index'));
        }

        $this->somProjectsRepository->delete($id);

        Flash::success('Som Projects deleted successfully.');

        return redirect(route('somProjects.index'));
    }
}
