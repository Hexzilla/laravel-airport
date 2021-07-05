<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsAdvisorsRequest;
use App\Http\Requests\UpdateSomProjectsAdvisorsRequest;
use App\Repositories\SomProjectsAdvisorsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectsAdvisorsController extends AppBaseController
{
    /** @var  SomProjectsAdvisorsRepository */
    private $somProjectsAdvisorsRepository;

    public function __construct(SomProjectsAdvisorsRepository $somProjectsAdvisorsRepo)
    {
        $this->somProjectsAdvisorsRepository = $somProjectsAdvisorsRepo;
    }

    /**
     * Display a listing of the SomProjectsAdvisors.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->all();

        return view('som_projects_advisors.index')
            ->with('somProjectsAdvisors', $somProjectsAdvisors);
    }

    /**
     * Show the form for creating a new SomProjectsAdvisors.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_projects_advisors.create');
    }

    /**
     * Store a newly created SomProjectsAdvisors in storage.
     *
     * @param CreateSomProjectsAdvisorsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsAdvisorsRequest $request)
    {
        $input = $request->all();

        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->create($input);

        Flash::success('Som Projects Advisors saved successfully.');

        return redirect(route('somProjectsAdvisors.index'));
    }

    /**
     * Display the specified SomProjectsAdvisors.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->find($id);

        if (empty($somProjectsAdvisors)) {
            Flash::error('Som Projects Advisors not found');

            return redirect(route('somProjectsAdvisors.index'));
        }

        return view('som_projects_advisors.show')->with('somProjectsAdvisors', $somProjectsAdvisors);
    }

    /**
     * Show the form for editing the specified SomProjectsAdvisors.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->find($id);

        if (empty($somProjectsAdvisors)) {
            Flash::error('Som Projects Advisors not found');

            return redirect(route('somProjectsAdvisors.index'));
        }

        return view('som_projects_advisors.edit')->with('somProjectsAdvisors', $somProjectsAdvisors);
    }

    /**
     * Update the specified SomProjectsAdvisors in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsAdvisorsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsAdvisorsRequest $request)
    {
        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->find($id);

        if (empty($somProjectsAdvisors)) {
            Flash::error('Som Projects Advisors not found');

            return redirect(route('somProjectsAdvisors.index'));
        }

        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->update($request->all(), $id);

        Flash::success('Som Projects Advisors updated successfully.');

        return redirect(route('somProjectsAdvisors.index'));
    }

    /**
     * Remove the specified SomProjectsAdvisors from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->find($id);

        if (empty($somProjectsAdvisors)) {
            Flash::error('Som Projects Advisors not found');

            return redirect(route('somProjectsAdvisors.index'));
        }

        $this->somProjectsAdvisorsRepository->delete($id);

        Flash::success('Som Projects Advisors deleted successfully.');

        return redirect(route('somProjectsAdvisors.index'));
    }
}
