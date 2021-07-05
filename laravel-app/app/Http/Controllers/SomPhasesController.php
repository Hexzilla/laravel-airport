<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomPhasesRequest;
use App\Http\Requests\UpdateSomPhasesRequest;
use App\Repositories\SomPhasesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomPhasesController extends AppBaseController
{
    /** @var  SomPhasesRepository */
    private $somPhasesRepository;

    public function __construct(SomPhasesRepository $somPhasesRepo)
    {
        $this->somPhasesRepository = $somPhasesRepo;
    }

    /**
     * Display a listing of the SomPhases.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somPhases = $this->somPhasesRepository->all();

        return view('som_phases.index')
            ->with('somPhases', $somPhases);
    }

    /**
     * Show the form for creating a new SomPhases.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_phases.create');
    }

    /**
     * Store a newly created SomPhases in storage.
     *
     * @param CreateSomPhasesRequest $request
     *
     * @return Response
     */
    public function store(CreateSomPhasesRequest $request)
    {
        $input = $request->all();

        $somPhases = $this->somPhasesRepository->create($input);

        Flash::success('Som Phases saved successfully.');

        return redirect(route('somPhases.index'));
    }

    /**
     * Display the specified SomPhases.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somPhases = $this->somPhasesRepository->find($id);

        if (empty($somPhases)) {
            Flash::error('Som Phases not found');

            return redirect(route('somPhases.index'));
        }

        return view('som_phases.show')->with('somPhases', $somPhases);
    }

    /**
     * Show the form for editing the specified SomPhases.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somPhases = $this->somPhasesRepository->find($id);

        if (empty($somPhases)) {
            Flash::error('Som Phases not found');

            return redirect(route('somPhases.index'));
        }

        return view('som_phases.edit')->with('somPhases', $somPhases);
    }

    /**
     * Update the specified SomPhases in storage.
     *
     * @param int $id
     * @param UpdateSomPhasesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomPhasesRequest $request)
    {
        $somPhases = $this->somPhasesRepository->find($id);

        if (empty($somPhases)) {
            Flash::error('Som Phases not found');

            return redirect(route('somPhases.index'));
        }

        $somPhases = $this->somPhasesRepository->update($request->all(), $id);

        Flash::success('Som Phases updated successfully.');

        return redirect(route('somPhases.index'));
    }

    /**
     * Remove the specified SomPhases from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somPhases = $this->somPhasesRepository->find($id);

        if (empty($somPhases)) {
            Flash::error('Som Phases not found');

            return redirect(route('somPhases.index'));
        }

        $this->somPhasesRepository->delete($id);

        Flash::success('Som Phases deleted successfully.');

        return redirect(route('somPhases.index'));
    }
}
