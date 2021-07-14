<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomCountryRequest;
use App\Http\Requests\UpdateSomCountryRequest;
use App\Repositories\SomCountryRepository;
use App\Repositories\SomCountryInfoRepository;
use App\Repositories\SomProjectsAirportRepository;
use App\Repositories\SomProjectsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomCountryController extends AppBaseController
{
    /** @var  SomCountryRepository */
    private $somCountryRepository;
    private $somCountryInfoRepository;
    private $somProjectsAirportRepository;
    private $somProjectsRepository;

    public function __construct(SomCountryRepository $somCountryRepo
        ,SomCountryInfoRepository $somCountryInfoRepository
        ,SomProjectsAirportRepository $somProjectsAirportRepository
        ,SomProjectsRepository $somProjectsRepository)
    {
        $this->somCountryRepository = $somCountryRepo;
        $this->somCountryInfoRepository = $somCountryInfoRepository;
        $this->somProjectsAirportRepository = $somProjectsAirportRepository;
        $this->somProjectsRepository = $somProjectsRepository;
    }

    /**
     * Display a listing of the SomCountry.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somCountries = $this->somCountryRepository->all();

        return view('som_countries.index')
            ->with('somCountries', $somCountries);
    }

    /**
     * Show the form for creating a new SomCountry.
     *
     * @return Response
     */
    public function create()
    {
        $max_id = $this->somCountryRepository->getLastInsertedId();
        $data = array();
        $data['id'] = $max_id+1;
        
        $items = array(1,2,3,4,5);

        return view('som_countries.create')->with('data', $data)->with('items', $items);
    }

    /**
     * Store a newly created SomCountry in storage.
     *
     * @param CreateSomCountryRequest $request
     *
     * @return Response
     */
    public function store(CreateSomCountryRequest $request)
    {
        // $input = $request->all();
        $input = $request->rules();

        $data = array();

        $data['id'] = $request->input('id');   
        if(!empty($request->input('country_code'))){
            $data['country_code'] = $request->input('country_code');
        }
        if(!empty($request->input('country'))){
            $data['country'] = $request->input('country');
        }
        if(!empty($request->input('description'))){
            $data['description'] = $request->input('description');
        }
        if(!empty($request->input('politics'))){
            $data['politics'] = $request->input('politics');
        }
        if(!empty($request->input('regulatory'))){
            $data['regulatory'] = $request->input('regulatory');
        }
        if(!empty($request->input('corruption'))){
            $data['corruption'] = $request->input('corruption');
        }
        if(!empty($request->input('business_easyness'))){
            $data['business_easyness'] = $request->input('business_easyness');
        }
        if(!empty($request->input('spain_affinity'))){
            $data['spain_affinity'] = $request->input('spain_affinity');
        }
        if(!empty($request->input('aena_strategy_align'))){
            $data['aena_strategy_align'] = $request->input('aena_strategy_align');
        }
        if(!empty($request->input('tourism_activity'))){
            $data['tourism_activity'] = $request->input('tourism_activity');
        }
        if(!empty($request->input('country_risk'))){
            $data['country_risk'] = $request->input('country_risk');
        }
        if(!empty($request->input('imports_exports'))){
            $data['imports_exports'] = $request->input('imports_exports');
        }
        if(!empty($request->input('version_date'))){
            $data['version_date'] = $request->input('version_date');
        }
        if(!empty($request->input('exchange_rate'))){
            $data['exchange_rate'] = $request->input('exchange_rate');
        }

        $this->somCountryRepository->insertData($data);
        // $somCountry = $this->somCountryRepository->create($input);

        Flash::success('Som Country saved successfully.');

        return redirect(route('somCountries.index'));
    }

    /**
     * Display the specified SomCountry.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somCountry = $this->somCountryRepository->find($id);

        if (empty($somCountry)) {
            Flash::error('Som Country not found');

            return redirect(route('somCountries.index'));
        }

        return view('som_countries.show')->with('somCountry', $somCountry);
    }

    /**
     * Show the form for editing the specified SomCountry.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $data = array();
        $data['id'] = $id;
        $somCountry = $this->somCountryRepository->find($id);

        if (empty($somCountry)) {
            Flash::error('Som Country not found');

            return redirect(route('somCountries.index'));
        }
        $items = array(1,2,3,4,5);

        return view('som_countries.edit')->with('somCountry', $somCountry)->with('data',$data)->with('items', $items);
    }

    /**
     * Update the specified SomCountry in storage.
     *
     * @param int $id
     * @param UpdateSomCountryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomCountryRequest $request)
    {
        $somCountry = $this->somCountryRepository->find($id);

        if (empty($somCountry)) {
            Flash::error('Som Country not found');

            return redirect(route('somCountries.index'));
        }

        $somCountry = $this->somCountryRepository->update($request->all(), $id);

        Flash::success('Som Country updated successfully.');

        return redirect(route('somCountries.index'));
    }

    /**
     * Remove the specified SomCountry from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somCountry = $this->somCountryRepository->find($id);

        if (empty($somCountry)) {
            Flash::error('Som Country not found');

            return redirect(route('somCountries.index'));
        }

        $project_count = $this->somProjectsRepository->getCountByCountryId($id);
        $airport_count = $this->somProjectsAirportRepository->getCountByCountryId($id);
        $info_count = $this->somCountryInfoRepository->getCountByCountryId($id);

        if($project_count>0 || $airport_count>0 || $info_count>0){
            Flash::error('It is being used in another menu.');
            return redirect(route('somCountries.index'));
        }

        $this->somCountryRepository->delete($id);

        Flash::success('Som Country deleted successfully.');

        return redirect(route('somCountries.index'));
    }
}
