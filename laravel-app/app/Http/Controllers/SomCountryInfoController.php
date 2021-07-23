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

use DataTables;
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;

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
        $somCountry_id = $request->get("somCountry_id");

        if ($request->ajax()) {

            $data = $this->somCountryInfoRepository->getAllData();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    $action .= "<a href=\"".route('somCountryInfos.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somCountryInfos.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_country_infos.index')
            ->with('somCountry_id',$somCountry_id);
    }

    /**
     * Show the form for creating a new SomCountryInfo.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

        $data = array();        
        $data['selected_year'] = ""; 

        $somCountry_id = $request->get("somCountry_id");

        return view('som_country_infos.create')->with('data', $data)
        ->with('somCountry_id',$somCountry_id);
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
        try{
            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

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
        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomCountryInfoController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somCountryInfos.index'));
        }         
            
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

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
        if (!CRUDBooster::isRead()) {
            CRUDBooster::insertLog(trans("crudbooster.log_try_view", ['module'=>CRUDBooster::getCurrentModule()->name]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

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
        if (!CRUDBooster::isRead()) {
            CRUDBooster::insertLog(trans("crudbooster.log_try_edit", ['module'=>CRUDBooster::getCurrentModule()->name]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

        $somCountryInfo = $this->somCountryInfoRepository->find($id);

        if (empty($somCountryInfo)) {
            Flash::error('Som Country Info not found');

            return redirect(route('somCountryInfos.index'));
        }

        $data = array();
        
        $data['selected_year'] = $somCountryInfo->year;  

        return view('som_country_infos.edit')->with('somCountryInfo', $somCountryInfo)->with('data', $data)
        ->with('somCountry_id',$somCountryInfo->som_country_id);
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
        try{

            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somCountryInfo = $this->somCountryInfoRepository->find($id);

            if (empty($somCountryInfo)) {
                Flash::error('Som Country Info not found');

                return redirect(route('somCountryInfos.index'));
            }

            $somCountryInfo = $this->somCountryInfoRepository->update($request->all(), $id);

        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomCountryInfoController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somCountryInfos.index'));
        } 
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));

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
        try{
            
            if(!CRUDBooster::isDelete()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_delete",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somCountryInfo = $this->somCountryInfoRepository->find($id);

            if (empty($somCountryInfo)) {
                Flash::error('Som Country Info not found');

                return redirect(route('somCountryInfos.index'));
            }

            $this->somCountryInfoRepository->delete($id);

        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomCountryInfoController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somCountryInfos.index'));
        } 
            
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('Som Country Info deleted successfully.');

        return redirect(route('somCountryInfos.index'));
    }
}
