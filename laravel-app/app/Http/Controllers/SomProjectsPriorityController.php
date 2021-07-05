<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsPriorityRequest;
use App\Http\Requests\UpdateSomProjectsPriorityRequest;
use App\Repositories\SomProjectsPriorityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectsPriorityController extends AppBaseController
{
    /** @var  SomProjectsPriorityRepository */
    private $somProjectsPriorityRepository;

    public function __construct(SomProjectsPriorityRepository $somProjectsPriorityRepo)
    {
        $this->somProjectsPriorityRepository = $somProjectsPriorityRepo;
    }

    /**
     * Display a listing of the SomProjectsPriority.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somProjectsPriorities = $this->somProjectsPriorityRepository->all();

        return view('som_projects_priorities.index')
            ->with('somProjectsPriorities', $somProjectsPriorities);
    }

    /**
     * Show the form for creating a new SomProjectsPriority.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_projects_priorities.create');
    }

    /**
     * Store a newly created SomProjectsPriority in storage.
     *
     * @param CreateSomProjectsPriorityRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsPriorityRequest $request)
    {
        $input = $request->all();

        $somProjectsPriority = $this->somProjectsPriorityRepository->create($input);

        Flash::success('Som Projects Priority saved successfully.');

        return redirect(route('somProjectsPriorities.index'));
    }

    /**
     * Display the specified SomProjectsPriority.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectsPriority = $this->somProjectsPriorityRepository->find($id);

        if (empty($somProjectsPriority)) {
            Flash::error('Som Projects Priority not found');

            return redirect(route('somProjectsPriorities.index'));
        }

        return view('som_projects_priorities.show')->with('somProjectsPriority', $somProjectsPriority);
    }

    /**
     * Show the form for editing the specified SomProjectsPriority.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectsPriority = $this->somProjectsPriorityRepository->find($id);

        if (empty($somProjectsPriority)) {
            Flash::error('Som Projects Priority not found');

            return redirect(route('somProjectsPriorities.index'));
        }

        return view('som_projects_priorities.edit')->with('somProjectsPriority', $somProjectsPriority);
    }

    /**
     * Update the specified SomProjectsPriority in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsPriorityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsPriorityRequest $request)
    {
        $somProjectsPriority = $this->somProjectsPriorityRepository->find($id);

        if (empty($somProjectsPriority)) {
            Flash::error('Som Projects Priority not found');

            return redirect(route('somProjectsPriorities.index'));
        }

        $somProjectsPriority = $this->somProjectsPriorityRepository->update($request->all(), $id);

        Flash::success('Som Projects Priority updated successfully.');

        return redirect(route('somProjectsPriorities.index'));
    }

    /**
     * Remove the specified SomProjectsPriority from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsPriority = $this->somProjectsPriorityRepository->find($id);

        if (empty($somProjectsPriority)) {
            Flash::error('Som Projects Priority not found');

            return redirect(route('somProjectsPriorities.index'));
        }

        $this->somProjectsPriorityRepository->delete($id);

        Flash::success('Som Projects Priority deleted successfully.');

        return redirect(route('somProjectsPriorities.index'));
    }
}
