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

use DataTables;
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

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
        if ($request->ajax()) {

            $data = $this->somCountryRepository->all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('version_date', function ($request) {
                    $version_date = "";
                    if(!empty($request->version_date)){
                        $version_date = date('Y-m-d', strtotime($request->version_date));
                    }
                    return $version_date; 
                })
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button addtional infomation                    
                    $action .= "<a href=\"".route("somCountryInfos.index",['somCountry_id'=> $row->id])."\" class='btn btn-default btn-xs'><i class='fa fa-info-circle'></i> Additional Infomation</a>";

                    //button show                
                    $action .= "<a href=\"".route('somCountries.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somCountries.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-edit'></i>";

                    //button delete
                    $action .= "</a>";
                    $action .= "<button class='btn btn-danger btn-xs' onclick='openDeleteModal(\"".$row->id."\")'><i class='far fa-trash-alt'></i></button>";

                    $action .= "</div>";
                    return $action;                        
                })                    
                ->rawColumns(['action'])                
                ->make(true);
        }else{
            if (!CRUDBooster::isView()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_view",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
            }
        }

        return view('som_countries.index');
    }

    /**
     * Show the form for creating a new SomCountry.
     *
     * @return Response
     */
    public function create()
    {
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

        $max_id = $this->somCountryRepository->getLastInsertedId();
        $data = array();
        $data['id'] = $max_id+1;
        
        $items = array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5',);

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
        try{

            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            // $input = $request->all();
            $input = $request->rules();

            $data = array();

            $data['id'] = $request->input('id');   
            if(!empty($request->input('country_code'))){
                $data['country_code'] = $request->input('country_code');
            }

            $countCountry = $this->somCountryRepository->getCountByCountryCode($request->input('country_code'));
            if($countCountry>0){
                Flash::error('Som Country already exist.');
                return redirect(route('somCountries.index'));
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

        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomCountryController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somCountries.index'));
        } 
            
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));
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
        if (!CRUDBooster::isRead()) {
            CRUDBooster::insertLog(trans("crudbooster.log_try_view", ['module'=>CRUDBooster::getCurrentModule()->name]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

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
        if (!CRUDBooster::isRead()) {
            CRUDBooster::insertLog(trans("crudbooster.log_try_edit", ['module'=>CRUDBooster::getCurrentModule()->name]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

        $data = array();
        $data['id'] = $id;
        $somCountry = $this->somCountryRepository->find($id);

        if (empty($somCountry)) {
            Flash::error('Som Country not found');

            return redirect(route('somCountries.index'));
        }
        
        $items = array('0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5',);

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
        try{

            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somCountry = $this->somCountryRepository->find($id);

            if (empty($somCountry)) {
                Flash::error('Som Country not found');

                return redirect(route('somCountries.index'));
            }

            $countCountry = $this->somCountryRepository->getCountByCountryCodeAndId($request->input('country_code'),$id);
            if($countCountry>0){
                Flash::error('Som Country already exist.');
                return redirect(route('somCountries.index'));
            }

            $somCountry = $this->somCountryRepository->update($request->all(), $id);

        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomCountryController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somCountries.index'));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));

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
        try{

            if(!CRUDBooster::isDelete()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_delete",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

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
            
        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomCountryController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somCountries.index'));
        }

            
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Country deleted successfully.');

        return redirect(route('somCountries.index'));
    }
}
