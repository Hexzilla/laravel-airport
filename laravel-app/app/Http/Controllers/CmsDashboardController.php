<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsDashboardRequest;
use App\Http\Requests\UpdateCmsDashboardRequest;
use App\Repositories\CmsDashboardRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;

class CmsDashboardController extends AppBaseController
{
    /** @var  CmsDashboardRepository */
    private $cmsDashboardRepository;

    public function __construct(CmsDashboardRepository $cmsDashboardRepo)
    {
        $this->cmsDashboardRepository = $cmsDashboardRepo;
    }

    /**
     * Display a listing of the CmsDashboard.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = $this->cmsDashboardRepository->all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($request) {
                    $created_at = "";
                    if(!empty($request->created_at)){
                        $created_at = date('Y-m-d H:i:s', strtotime($request->created_at));
                    }
                    return $created_at; 
                })
                ->editColumn('updated_at', function ($request) {
                    $updated_at = "";
                    if(!empty($request->updated_at)){
                        $updated_at = date('Y-m-d H:i:s', strtotime($request->updated_at));
                    }
                    return $updated_at; 
                })
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    $action .= "<a href=\"".route('cmsDashboards.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('cmsDashboards.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-edit'></i>";

                    //button delete
                    $action .= "</a>";
                    $action .= "<button class='btn btn-danger btn-xs' onclick='openDeleteModal(\"".$row->id."\")'><i class='far fa-trash-alt'></i></button>";

                    $action .= "</div>";
                    return $action;                        
                })                    
                ->rawColumns(['action'])                
                ->make(true);
        }

        return view('cms_dashboards.index');
    }

    /**
     * Show the form for creating a new CmsDashboard.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_dashboards.create');
    }

    /**
     * Store a newly created CmsDashboard in storage.
     *
     * @param CreateCmsDashboardRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsDashboardRequest $request)
    {
        $input = $request->all();

        $cmsDashboard = $this->cmsDashboardRepository->create($input);

        Flash::success('Cms Dashboard saved successfully.');

        return redirect(route('cmsDashboards.index'));
    }

    /**
     * Display the specified CmsDashboard.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsDashboard = $this->cmsDashboardRepository->find($id);

        if (empty($cmsDashboard)) {
            Flash::error('Cms Dashboard not found');

            return redirect(route('cmsDashboards.index'));
        }

        return view('cms_dashboards.show')->with('cmsDashboard', $cmsDashboard);
    }

    /**
     * Show the form for editing the specified CmsDashboard.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsDashboard = $this->cmsDashboardRepository->find($id);

        if (empty($cmsDashboard)) {
            Flash::error('Cms Dashboard not found');

            return redirect(route('cmsDashboards.index'));
        }

        return view('cms_dashboards.edit')->with('cmsDashboard', $cmsDashboard);
    }

    /**
     * Update the specified CmsDashboard in storage.
     *
     * @param int $id
     * @param UpdateCmsDashboardRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsDashboardRequest $request)
    {
        $cmsDashboard = $this->cmsDashboardRepository->find($id);

        if (empty($cmsDashboard)) {
            Flash::error('Cms Dashboard not found');

            return redirect(route('cmsDashboards.index'));
        }

        $cmsDashboard = $this->cmsDashboardRepository->update($request->all(), $id);

        Flash::success('Cms Dashboard updated successfully.');

        return redirect(route('cmsDashboards.index'));
    }

    /**
     * Remove the specified CmsDashboard from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsDashboard = $this->cmsDashboardRepository->find($id);

        if (empty($cmsDashboard)) {
            Flash::error('Cms Dashboard not found');

            return redirect(route('cmsDashboards.index'));
        }

        $this->cmsDashboardRepository->delete($id);

        Flash::success('Cms Dashboard deleted successfully.');

        return redirect(route('cmsDashboards.index'));
    }
}
