<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomNewsRequest;
use App\Http\Requests\UpdateSomNewsRequest;
use App\Repositories\SomNewsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;
use App\Http\Utils\CRUDBooster;
use App\Http\Utils\SomLogger;


class SomNewsController extends AppBaseController
{
    /** @var  SomNewsRepository */
    private $somNewsRepository;

    public function __construct(SomNewsRepository $somNewsRepo)
    {
        $this->somNewsRepository = $somNewsRepo;
    }

    /**
     * Display a listing of the SomNews.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {    
        if ($request->ajax()) { 
            $data = $this->somNewsRepository->all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('date_from', function ($request) {
                    $date_from = "";
                    if(!empty($request->date_from)){
                        $date_from = date('Y-m-d', strtotime($request->date_from));
                    }
                    return $date_from;
                })
                ->editColumn('date_until', function ($request) {
                    $date_until = "";
                    if(!empty($request->date_until)){
                        $date_until = date('Y-m-d', strtotime($request->date_until));
                    }
                    return $date_until;
                })
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show
                    // $action .= "<a href=\"".route('somNews.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    // $action .= "<i class='far fa-eye'></i>";
                    // $action .= "</a>";

                    //button edit
                    $action .= "<a href=\"".route('somNews.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='fas fa-pencil-alt'></i>";

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

        return view('som_news.index');
    }

    /**
     * Show the form for creating a new SomNews.
     *
     * @return Response
     */
    public function create()
    {
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }
        return view('som_news.create');
    }

    /**
     * Store a newly created SomNews in storage.
     *
     * @param CreateSomNewsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomNewsRequest $request)
    {
        try{

            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $input = $request->all();

            $somNews = $this->somNewsRepository->create($input);

        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomNewsController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somNews.index'));
        }

        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('News saved successfully.');

        // return redirect(route('somNews.index'));
        if(!empty($request->input('sub1'))){ //save
            return redirect(route('somNews.index'));
        }else{ //save and more add
            return redirect(route('somNews.create'));
        }
    }

    /**
     * Display the specified SomNews.
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

        $somNews = $this->somNewsRepository->find($id);

        if (empty($somNews)) {
            Flash::error('News not found');

            return redirect(route('somNews.index'));
        }

        return view('som_news.show')->with('somNews', $somNews);
    }

    /**
     * Display a listing of the SomNews.
     * POST /news
     *
     * @param Request $request
     * @return Response
     */
    public function news(Request $request)
    {
        $date_from = $request->input('date_from');
        $date_until = $request->input('date_until');

        if ($date_from == null || $date_until == null) {
            return response()->json([
                'api_status' => 'KO',
                'api_message' => 'Missing parameters'
            ], 401);
        }

        $somNews = $this->somNewsRepository->news($date_from, $date_until);

        return response()->json([
            'api_status' => 'OK',
            'api_message' => '',
            'data' => $somNews->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified SomNews.
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

        $somNews = $this->somNewsRepository->find($id);

        if (empty($somNews)) {
            Flash::error('Som News not found');

            return redirect(route('somNews.index'));
        }

        return view('som_news.edit')->with('somNews', $somNews);
    }

    /**
     * Update the specified SomNews in storage.
     *
     * @param int $id
     * @param UpdateSomNewsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomNewsRequest $request)
    {
        try{

            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somNews = $this->somNewsRepository->find($id);

            if (empty($somNews)) {
                Flash::error('Som News not found');

                return redirect(route('somNews.index'));
            }

            $somNews = $this->somNewsRepository->update($request->all(), $id);

        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomNewsController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somNews.index'));
        } 
            
        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));        

        Flash::success('News updated successfully.');

        return redirect(route('somNews.index'));
    }

    /**
     * Remove the specified SomNews from storage.
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
            $somNews = $this->somNewsRepository->find($id);

            if (empty($somNews)) {
                Flash::error('News not found');

                return redirect(route('somNews.index'));
            }

            $this->somNewsRepository->delete($id);

        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomNewsController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somNews.index'));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));

        Flash::success('News deleted successfully.');

        return redirect(route('somNews.index'));
    }
}
