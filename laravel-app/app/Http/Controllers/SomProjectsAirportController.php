<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsAirportRequest;
use App\Http\Requests\UpdateSomProjectsAirportRequest;
use App\Repositories\SomProjectsAirportRepository;
use App\Repositories\SomCountryRepository;
use App\Repositories\SomProjectsAirportTypeRepository;
use App\Repositories\SomProjectsAdditionalAirportRepository;
use App\Repositories\SomProjectsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomProjectsAirportController extends AppBaseController
{
    /** @var  SomProjectsAirportRepository */
    private $somProjectsAirportRepository;
    private $somCountryRepository;
    private $somProjectsAirportTypeRepository;
    private $somProjectsAdditionalAirportRepository;
    private $somProjectsRepository;

    public function __construct(SomProjectsAirportRepository $somProjectsAirportRepo
        , SomCountryRepository $somCountryRepository
        , SomProjectsAirportTypeRepository $somProjectsAirportTypeRepository
        , SomProjectsAdditionalAirportRepository $somProjectsAdditionalAirportRepository
        , SomProjectsRepository $somProjectsRepository)
    {
        $this->somProjectsAirportRepository = $somProjectsAirportRepo;
        $this->somCountryRepository = $somCountryRepository;
        $this->somProjectsAirportTypeRepository = $somProjectsAirportTypeRepository;
        $this->somProjectsAdditionalAirportRepository = $somProjectsAdditionalAirportRepository;
        $this->somProjectsRepository = $somProjectsRepository;
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

        $data = array();

        $data['airport_types'] = array();

        $airport_types = $this->somProjectsAirportTypeRepository->all();
        foreach ($airport_types as $airport_type) {
            $data['airport_types'][$airport_type->id] = $airport_type->name;
        }

        return view('som_projects_airports.index')
            ->with('somProjectsAirports', $somProjectsAirports)
            ->with('data', $data);
    }

    /**
     * Show the form for creating a new SomProjectsAirport.
     *
     * @return Response
     */
    public function create()
    {
        $max_id = $this->somProjectsAirportRepository->getLastInsertedId();
        $data = array();
        $data['id'] = $max_id+1;

        $data['countries'] = array();
        $somCountries = $this->somCountryRepository->all();
        $cnt = 0;
        $selected_country_id = 0;
        foreach ($somCountries as $somCountry) {
            $data['countries'][$somCountry->id] = $somCountry->country;
            if($cnt == 0){
                $selected_country_id = $somCountry->id;
            }
            $cnt++;
        }     

        $data['airport_types'] = array();
        $airport_types = $this->somProjectsAirportTypeRepository->all();
        foreach ($airport_types as $airport_type) {
            $data['airport_types'][$airport_type->id] = $airport_type->name;
        }

        $data['selected_country'] = $selected_country_id;
        $data['selected_airport'] = 0;

        return view('som_projects_airports.create')
            ->with('data', $data);
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
        // $input = $request->all();
        $input = $request->rules();
        
        $data = array();

        $data['id'] = $request->input('id');
        $data['name'] = $request->input('name');   
        if(!empty($request->input('address'))){
            $data['address'] = $request->input('address');
        } 
        if(!empty($request->input('country'))){
            $data['country'] = $request->input('country');
        } 
        if(!empty($request->input('iata_oaci'))){
            $data['iata_oaci'] = $request->input('iata_oaci');
        } 
        if(!empty($request->input('som_projects_airport_type_id'))){
            $data['som_projects_airport_type_id'] = $request->input('som_projects_airport_type_id');
        } 
        if(!empty($request->input('size'))){
            $data['size'] = $request->input('size');
        } 
        if(!empty($request->input('revenues_aeronautical'))){
            $data['revenues_aeronautical'] = $request->input('revenues_aeronautical');
        } 
        if(!empty($request->input('revenues_non_aeronautical'))){
            $data['revenues_non_aeronautical'] = $request->input('revenues_non_aeronautical');
        } 
        if(!empty($request->input('total_revenues'))){
            $data['total_revenues'] = $request->input('total_revenues');
        } 
        if(!empty($request->input('total_opex'))){
            $data['total_opex'] = $request->input('total_opex');
        } 
        if(!empty($request->input('ebitda'))){
            $data['ebitda'] = $request->input('ebitda');
        } 
        if(!empty($request->input('kpi_revenues_aeronautical'))){
            $data['kpi_revenues_aeronautical'] = $request->input('kpi_revenues_aeronautical');
        } 
        if(!empty($request->input('kpi_revenues_non_aeronautical'))){
            $data['kpi_revenues_non_aeronautical'] = $request->input('kpi_revenues_non_aeronautical');
        } 
        if(!empty($request->input('kpi_ebitda'))){
            $data['kpi_ebitda'] = $request->input('kpi_ebitda');
        } 
        if(!empty($request->input('debt_ebitda'))){
            $data['debt_ebitda'] = $request->input('debt_ebitda');
        } 
        
        if(!empty($request->input('percentage_international'))){
            $data['percentage_international'] = $request->input('percentage_international');
        } 
        if(!empty($request->input('percentage_transfer'))){
            $data['percentage_transfer'] = $request->input('percentage_transfer');
        } 
        if(!empty($request->input('percentage_non_low_cost'))){
            $data['percentage_non_low_cost'] = $request->input('percentage_non_low_cost');
        } 
        if(!empty($request->input('infrastructure_characterization_description'))){
            $data['infrastructure_characterization_description'] = $request->input('infrastructure_characterization_description');
        } 
        if(!empty($request->input('airport_catchment_area'))){
            $data['airport_catchment_area'] = $request->input('airport_catchment_area');
        } 
        if(!empty($request->input('competitors'))){
            $data['competitors'] = $request->input('competitors');
        } 
        if(!empty($request->input('top1_airline'))){
            $data['top1_airline'] = $request->input('top1_airline');
        } 
        if(!empty($request->input('top1_airline_percentage'))){
            $data['top1_airline_percentage'] = $request->input('top1_airline_percentage');
        } 
        if(!empty($request->input('top2_airline'))){
            $data['top2_airline'] = $request->input('top2_airline');
        } 
        if(!empty($request->input('top2_airline_percentage'))){
            $data['top2_airline_percentage'] = $request->input('top2_airline_percentage');
        } 
        if(!empty($request->input('top3_airline'))){
            $data['top3_airline'] = $request->input('top3_airline');
        } 
        if(!empty($request->input('top3_airline_percentage'))){
            $data['top3_airline_percentage'] = $request->input('top3_airline_percentage');
        } 
        if(!empty($request->input('route'))){
            $data['route'] = $request->input('route');
        }
        if(!empty($request->input('master_plan_estimations'))){
            $data['master_plan_estimations'] = $request->input('master_plan_estimations');
        }
        if(!empty($request->input('society_model_regulation'))){
            $data['society_model_regulation'] = $request->input('society_model_regulation');
        }
        if(!empty($request->input('aena_network_improvement'))){
            $data['aena_network_improvement'] = $request->input('aena_network_improvement');
        }
        if(!empty($request->input('other_info'))){
            $data['other_info'] = $request->input('other_info');
        }
        if(!empty($request->input('data_year'))){
            $data['data_year'] = $request->input('data_year');
        }
        if(!empty($request->input('version_date'))){
            $data['version_date'] = $request->input('version_date');
        } 
        if(!empty($request->input('som_country_id'))){
            $data['som_country_id'] = $request->input('som_country_id');
        } 
        if(!empty($request->input('lat'))){
            $data['lat'] = $request->input('lat');
        } 
        if(!empty($request->input('long'))){
            $data['long'] = $request->input('long');
        }  
        if($request->file()) {
            $this->validate($request, [
                'file' => 'mimes:jpeg,jpg,png,gif', //only allow this type extension file.
            ]);

            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');            
            $data['img_url'] = '/storage/app/public/' .$filePath;            
        }     

        $this->somProjectsAirportRepository->insertData($data);

        // $somProjectsAirport = $this->somProjectsAirportRepository->create($input);

        Flash::success('Som Projects Airport saved successfully.');

        return redirect(route('somAirports.index'));
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

            return redirect(route('somAirports.index'));
        }

        $data = array();
        $data['id'] = $id;
        $data['countries'] = array();
        $somCountries = $this->somCountryRepository->all();
        foreach ($somCountries as $somCountry) {
            $data['countries'][$somCountry->id] = $somCountry->country;
        }     

        $data['airport_types'] = array();
        $airport_types = $this->somProjectsAirportTypeRepository->all();
        foreach ($airport_types as $airport_type) {
            $data['airport_types'][$airport_type->id] = $airport_type->name;
        }

        $selected_country_id = 0;
        if(!empty($somProjectsAirport->som_country_id)){
            $selected_country_id = $somProjectsAirport->som_country_id;
        }
        $data['selected_country'] = $selected_country_id;
        $data['selected_airport'] = $somProjectsAirport->som_projects_airport_type_id;
        
        // $data['somProjectsAirport'] = $somProjectsAirport;

        return view('som_projects_airports.edit')->with('somProjectsAirport', $somProjectsAirport)
        ->with('data',$data);
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

            return redirect(route('somAirports.index'));
        }

        $somProjectsAirport = $this->somProjectsAirportRepository->update($request->all(), $id);

        $data = array();
        if($request->file()) {
            $this->validate($request, [
                'file' => 'mimes:jpeg,jpg,png,gif', //only allow this type extension file.
            ]);

            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');            
            $data['img_url'] = '/storage/app/public/' .$filePath; 
            $this->somProjectsAirportRepository->updateData($id, $data);           
        }     

        

        Flash::success('Som Projects Airport updated successfully.');

        return redirect(route('somAirports.index'));
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

            return redirect(route('somAirports.index'));
        }

        $addional_count = $this->somProjectsAdditionalAirportRepository->getCountByAirportId($id);
        $projects_count = $this->somProjectsRepository->getCountByAirportId($id);
        
        if($addional_count>0 || $projects_count>0){
            Flash::error('Delete in Prjects/AddionalAirports');
            return redirect(route('somAirports.index'));
        }

        $this->somProjectsAirportRepository->delete($id);

        Flash::success('Som Projects Airport deleted successfully.');

        return redirect(route('somAirports.index'));
    }
}
