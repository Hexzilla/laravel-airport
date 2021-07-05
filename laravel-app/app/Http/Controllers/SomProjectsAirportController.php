<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsAirportRequest;
use App\Http\Requests\UpdateSomProjectsAirportRequest;
use App\Repositories\SomProjectsAirportRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectsAirportController extends AppBaseController
{
    /** @var  SomProjectsAirportRepository */
    private $somProjectsAirportRepository;

    public function __construct(SomProjectsAirportRepository $somProjectsAirportRepo)
    {
        $this->somProjectsAirportRepository = $somProjectsAirportRepo;
    }

    /**
     * Display a listing of the SomProjectsAirport.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somProjectsAirports = $this->somProjectsAirportRepository->all();

        return view('som_projects_airports.index')
            ->with('somProjectsAirports', $somProjectsAirports);
    }

    /**
     * Show the form for creating a new SomProjectsAirport.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_projects_airports.create');
    }

    /**
     * Store a newly created SomProjectsAirport in storage.
     *
     * @param CreateSomProjectsAirportRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsAirportRequest $request)
    {
        $input = $request->all();

        $somProjectsAirport = $this->somProjectsAirportRepository->create($input);

        Flash::success('Som Projects Airport saved successfully.');

        return redirect(route('somProjectsAirports.index'));
    }

    /**
     * Display the specified SomProjectsAirport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectsAirport = $this->somProjectsAirportRepository->find($id);

        if (empty($somProjectsAirport)) {
            Flash::error('Som Projects Airport not found');

            return redirect(route('somProjectsAirports.index'));
        }

        return view('som_projects_airports.show')->with('somProjectsAirport', $somProjectsAirport);
    }

    /**
     * Show the form for editing the specified SomProjectsAirport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectsAirport = $this->somProjectsAirportRepository->find($id);

        if (empty($somProjectsAirport)) {
            Flash::error('Som Projects Airport not found');

            return redirect(route('somProjectsAirports.index'));
        }

        return view('som_projects_airports.edit')->with('somProjectsAirport', $somProjectsAirport);
    }

    /**
     * Update the specified SomProjectsAirport in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsAirportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsAirportRequest $request)
    {
        $somProjectsAirport = $this->somProjectsAirportRepository->find($id);

        if (empty($somProjectsAirport)) {
            Flash::error('Som Projects Airport not found');

            return redirect(route('somProjectsAirports.index'));
        }

        $somProjectsAirport = $this->somProjectsAirportRepository->update($request->all(), $id);

        Flash::success('Som Projects Airport updated successfully.');

        return redirect(route('somProjectsAirports.index'));
    }

    /**
     * Remove the specified SomProjectsAirport from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsAirport = $this->somProjectsAirportRepository->find($id);

        if (empty($somProjectsAirport)) {
            Flash::error('Som Projects Airport not found');

            return redirect(route('somProjectsAirports.index'));
        }

        $this->somProjectsAirportRepository->delete($id);

        Flash::success('Som Projects Airport deleted successfully.');

        return redirect(route('somProjectsAirports.index'));
    }
}
