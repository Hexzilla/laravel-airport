<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsAdditionalAirportRequest;
use App\Http\Requests\UpdateSomProjectsAdditionalAirportRequest;
use App\Repositories\SomProjectsAdditionalAirportRepository;
use App\Repositories\SomProjectsAirportRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectsAdditionalAirportController extends AppBaseController
{
    /** @var  SomProjectsAdditionalAirportRepository */
    private $somProjectsAdditionalAirportRepository;
    private $somProjectsAirportRepository;

    public function __construct(
        SomProjectsAdditionalAirportRepository $somProjectsAdditionalAirportRepo,
        SomProjectsAirportRepository $somProjectsAirportRepo
        )
    {
        $this->somProjectsAdditionalAirportRepository = $somProjectsAdditionalAirportRepo;
        $this->somProjectsAirportRepository = $somProjectsAirportRepo;
    }

    /**
     * Display a listing of the SomProjectsAdditionalAirport.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //JOIN BY PROJECT_ID---
        $projectId = $request->input('project_id');
        $somProjectsAdditionalAirports = $this->somProjectsAdditionalAirportRepository->all(['som_project_id' => $projectId]);
        //---------------------

        return view('som_projects_additional_airports.index')
            ->with('projectId', $projectId)
            ->with('somProjectsAdditionalAirports', $somProjectsAdditionalAirports);
    }

    /**
     * Show the form for creating a new SomProjectsAdditionalAirport.
     *
     * @return Response
     */
    public function create(Request $request)
    {
    	$somProjectsId = $request->input('project_id');
        $somProjectsAirports= $this->somProjectsAirportRepository->all([], null, null, ['id', 'name']);
        
        $airports = array(0 => '**Please Select a Airport');
        foreach($somProjectsAirports->toArray() as $rows)
        {
            $airports[$rows['id']] = $rows['name'];
        }
        return view('som_projects_additional_airports.create')
                    ->with('somEditId', 0)
                    ->with('somProjectsId', $somProjectsId)
                    ->with('somProjectsAirports', $airports)
                    ->with('selectedItem', 0);

    }

    /**
     * Store a newly created SomProjectsAdditionalAirport in storage.
     *
     * @param CreateSomProjectsAdditionalAirportRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsAdditionalAirportRequest $request)
    {
        $input = $request->all();
        $somProjectsAdditionalAirport = $this->somProjectsAdditionalAirportRepository->create($input);

        Flash::success('Som Projects Additional Airport saved successfully.');
        
        $projectId = $request->input('som_project_id');
        return redirect(route('somProjectsAdditionalAirports.index', ['project_id' => $projectId]));
    }

    /**
     * Display the specified SomProjectsAdditionalAirport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectsAdditionalAirport = $this->somProjectsAdditionalAirportRepository->find($id);

        if (empty($somProjectsAdditionalAirport)) {
            Flash::error('Som Projects Additional Airport not found');

            return redirect(route('somProjectsAdditionalAirports.index'));
        }

        return view('som_projects_additional_airports.show')->with('somProjectsAdditionalAirport', $somProjectsAdditionalAirport);
    }

    /**
     * Show the form for editing the specified SomProjectsAdditionalAirport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectsAdditionalAirport = $this->somProjectsAdditionalAirportRepository->find($id);
        if (empty($somProjectsAdditionalAirport)) {
            Flash::error('Som Projects Additional Airport not found');

            return redirect(route('somProjectsAdditionalAirports.index'));
        }

        $somProjectsAirports= $this->somProjectsAirportRepository->all([], null, null, ['id', 'name']);
        $somProjectsId = $somProjectsAdditionalAirport->som_project_id;
        $selectedItem = $somProjectsAdditionalAirport->som_airport_id;
        $airports = array(0 => '**Please Select a Airport');
        foreach($somProjectsAirports->toArray() as $rows)
        {
            $airports[$rows['id']] = $rows['name'];
        }
        return view('som_projects_additional_airports.edit')
            ->with('somEditId', $id)
            ->with('somProjectsId', $somProjectsId)
            ->with('somProjectsAirports', $airports )
            ->with('selectedItem', $selectedItem)
            ->with('somProjectsAdditionalAirport', $somProjectsAdditionalAirport);
    }

    /**
     * Update the specified SomProjectsAdditionalAirport in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsAdditionalAirportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsAdditionalAirportRequest $request)
    {
        $somProjectsAdditionalAirport = $this->somProjectsAdditionalAirportRepository->find($id);

        if (empty($somProjectsAdditionalAirport)) {
            Flash::error('Som Projects Additional Airport not found');

            return redirect(route('somProjectsAdditionalAirports.index'));
        }

        $somProjectsAdditionalAirport = $this->somProjectsAdditionalAirportRepository->update($request->all(), $id);
        $somProjectsAdditionalAirportArray = $somProjectsAdditionalAirport->toArray();
        $somProjectsId = $somProjectsAdditionalAirportArray['som_project_id'];

        Flash::success('Som Projects Additional Airport updated successfully.');

        return redirect(route('somProjectsAdditionalAirports.index', ['project_id' => $somProjectsId]));
    }

    /**
     * Remove the specified SomProjectsAdditionalAirport from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsAdditionalAirport = $this->somProjectsAdditionalAirportRepository->find($id);

        if (empty($somProjectsAdditionalAirport)) {
            Flash::error('Som Projects Additional Airport not found');

            return redirect(route('somProjectsAdditionalAirports.index'));
        }

        $this->somProjectsAdditionalAirportRepository->delete($id);
        $somProjectsAdditionalAirportArray = $somProjectsAdditionalAirport->toArray();
        $somProjectsId = $somProjectsAdditionalAirportArray['som_project_id'];

        Flash::success('Som Projects Additional Airport deleted successfully.');

        return redirect(route('somProjectsAdditionalAirports.index', ['project_id' => $somProjectsId]));
    }
}