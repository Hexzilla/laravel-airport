<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsAirportTypeRequest;
use App\Http\Requests\UpdateSomProjectsAirportTypeRequest;
use App\Repositories\SomProjectsAirportTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectsAirportTypeController extends AppBaseController
{
    /** @var  SomProjectsAirportTypeRepository */
    private $somProjectsAirportTypeRepository;

    public function __construct(SomProjectsAirportTypeRepository $somProjectsAirportTypeRepo)
    {
        $this->somProjectsAirportTypeRepository = $somProjectsAirportTypeRepo;
    }

    /**
     * Display a listing of the SomProjectsAirportType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somProjectsAirportTypes = $this->somProjectsAirportTypeRepository->all();

        return view('som_projects_airport_types.index')
            ->with('somProjectsAirportTypes', $somProjectsAirportTypes);
    }

    /**
     * Show the form for creating a new SomProjectsAirportType.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_projects_airport_types.create');
    }

    /**
     * Store a newly created SomProjectsAirportType in storage.
     *
     * @param CreateSomProjectsAirportTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsAirportTypeRequest $request)
    {
        $input = $request->all();

        $somProjectsAirportType = $this->somProjectsAirportTypeRepository->create($input);

        Flash::success('Som Projects Airport Type saved successfully.');

        return redirect(route('somProjectsAirportTypes.index'));
    }

    /**
     * Display the specified SomProjectsAirportType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectsAirportType = $this->somProjectsAirportTypeRepository->find($id);

        if (empty($somProjectsAirportType)) {
            Flash::error('Som Projects Airport Type not found');

            return redirect(route('somProjectsAirportTypes.index'));
        }

        return view('som_projects_airport_types.show')->with('somProjectsAirportType', $somProjectsAirportType);
    }

    /**
     * Show the form for editing the specified SomProjectsAirportType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectsAirportType = $this->somProjectsAirportTypeRepository->find($id);

        if (empty($somProjectsAirportType)) {
            Flash::error('Som Projects Airport Type not found');

            return redirect(route('somProjectsAirportTypes.index'));
        }

        return view('som_projects_airport_types.edit')->with('somProjectsAirportType', $somProjectsAirportType);
    }

    /**
     * Update the specified SomProjectsAirportType in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsAirportTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsAirportTypeRequest $request)
    {
        $somProjectsAirportType = $this->somProjectsAirportTypeRepository->find($id);

        if (empty($somProjectsAirportType)) {
            Flash::error('Som Projects Airport Type not found');

            return redirect(route('somProjectsAirportTypes.index'));
        }

        $somProjectsAirportType = $this->somProjectsAirportTypeRepository->update($request->all(), $id);

        Flash::success('Som Projects Airport Type updated successfully.');

        return redirect(route('somProjectsAirportTypes.index'));
    }

    /**
     * Remove the specified SomProjectsAirportType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsAirportType = $this->somProjectsAirportTypeRepository->find($id);

        if (empty($somProjectsAirportType)) {
            Flash::error('Som Projects Airport Type not found');

            return redirect(route('somProjectsAirportTypes.index'));
        }

        $this->somProjectsAirportTypeRepository->delete($id);

        Flash::success('Som Projects Airport Type deleted successfully.');

        return redirect(route('somProjectsAirportTypes.index'));
    }
}
