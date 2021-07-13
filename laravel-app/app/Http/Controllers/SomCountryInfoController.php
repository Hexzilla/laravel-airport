<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomCountryInfoRequest;
use App\Http\Requests\UpdateSomCountryInfoRequest;
use App\Repositories\SomCountryInfoRepository;
use App\Repositories\SomCountryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SomCountryInfoController extends AppBaseController
{
    /** @var  SomCountryInfoRepository */
    private $somCountryInfoRepository;
    private $somCountryRepository;

    public function __construct(SomCountryInfoRepository $somCountryInfoRepo
        ,SomCountryRepository $somCountryRepository)
    {
        $this->somCountryInfoRepository = $somCountryInfoRepo;
        $this->somCountryRepository = $somCountryRepository;
    }

    /**
     * Display a listing of the SomCountryInfo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somCountryInfos = $this->somCountryInfoRepository->all();

        $data = array();
        $data['countries'] = array();
        $somCountries = $this->somCountryRepository->all();        
        foreach ($somCountries as $somCountry) {            
            $data['countries'][$somCountry->id] = $somCountry->country;
        }

        return view('som_country_infos.index')
            ->with('somCountryInfos', $somCountryInfos)
            ->with('data', $data);
    }

    /**
     * Show the form for creating a new SomCountryInfo.
     *
     * @return Response
     */
    public function create()
    {
        $data = array();
        $data['countries'] = array();
        $somCountries = $this->somCountryRepository->all();
        foreach ($somCountries as $somCountry) {            
            $data['countries'][$somCountry->id] = $somCountry->country;
        }  
        $data['selected_country'] = 0; 
        $data['selected_year'] = ""; 
        return view('som_country_infos.create')->with('data', $data);
    }

    /**
     * Store a newly created SomCountryInfo in storage.
     *
     * @param CreateSomCountryInfoRequest $request
     *
     * @return Response
     */
    public function store(CreateSomCountryInfoRequest $request)
    {
        // $validated = $request->validated();

        // if (array_key_exists('som_country_id', $validated)) {
        //     unset($validated['som_country_id']);
        // }

        $input = $request->rules();

        $data = array();
        if(!empty($request->input('som_country_id'))){
            $data['som_country_id'] = $request->input('som_country_id');
        } 
        if(!empty($request->input('year'))){
            $data['year'] = $request->input('year');
        } 
        if(!empty($request->input('inflation'))){
            $data['inflation'] = $request->input('inflation');
        } 
        if(!empty($request->input('population'))){
            $data['population'] = $request->input('population');
        } 
        if(!empty($request->input('gpd_evolution'))){
            $data['gpd_evolution'] = $request->input('gpd_evolution');
        } 

        $this->somCountryInfoRepository->insertData($data);

        // $somCountryInfo = $this->somCountryInfoRepository->create($validated);

        Flash::success('Som Country Info saved successfully.');

        return redirect(route('somCountryInfos.index'));
    }

    /**
     * Display the specified SomCountryInfo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somCountryInfo = $this->somCountryInfoRepository->find($id);

        if (empty($somCountryInfo)) {
            Flash::error('Som Country Info not found');

            return redirect(route('somCountryInfos.index'));
        }

        return view('som_country_infos.show')->with('somCountryInfo', $somCountryInfo);
    }

    /**
     * Show the form for editing the specified SomCountryInfo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somCountryInfo = $this->somCountryInfoRepository->find($id);

        if (empty($somCountryInfo)) {
            Flash::error('Som Country Info not found');

            return redirect(route('somCountryInfos.index'));
        }

        $data = array();
        $data['countries'] = array();
        $somCountries = $this->somCountryRepository->all();
        foreach ($somCountries as $somCountry) {            
            $data['countries'][$somCountry->id] = $somCountry->country;
        }   

        $data['selected_country'] = $somCountryInfo->som_country_id;
        $data['selected_year'] = $somCountryInfo->year;  

        return view('som_country_infos.edit')->with('somCountryInfo', $somCountryInfo)->with('data', $data);
    }

    /**
     * Update the specified SomCountryInfo in storage.
     *
     * @param int $id
     * @param UpdateSomCountryInfoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomCountryInfoRequest $request)
    {
        $somCountryInfo = $this->somCountryInfoRepository->find($id);

        if (empty($somCountryInfo)) {
            Flash::error('Som Country Info not found');

            return redirect(route('somCountryInfos.index'));
        }

        $somCountryInfo = $this->somCountryInfoRepository->update($request->all(), $id);

        Flash::success('Som Country Info updated successfully.');

        return redirect(route('somCountryInfos.index'));
    }

    /**
     * Remove the specified SomCountryInfo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somCountryInfo = $this->somCountryInfoRepository->find($id);

        if (empty($somCountryInfo)) {
            Flash::error('Som Country Info not found');

            return redirect(route('somCountryInfos.index'));
        }

        $this->somCountryInfoRepository->delete($id);

        Flash::success('Som Country Info deleted successfully.');

        return redirect(route('somCountryInfos.index'));
    }
}
