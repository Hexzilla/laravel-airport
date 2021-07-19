<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsAdvisorsRequest;
use App\Http\Requests\UpdateSomProjectsAdvisorsRequest;
use App\Repositories\SomProjectsAdvisorsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;

class SomProjectsAdvisorsController extends AppBaseController
{
    /** @var  SomProjectsAdvisorsRepository */
    private $somProjectsAdvisorsRepository;

    public function __construct(SomProjectsAdvisorsRepository $somProjectsAdvisorsRepo)
    {
        $this->somProjectsAdvisorsRepository = $somProjectsAdvisorsRepo;
    }

    /**
     * Display a listing of the SomProjectsAdvisors.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $somProjectsID = $request->input('project_id');

        if ($request->ajax()) {

            $data = $this->somProjectsAdvisorsRepository->all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    $action .= "<a href=\"".route('somProjectsAdvisors.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somProjectsAdvisors.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_projects_advisors.index')
            ->with('somProjectID',$somProjectsID);
    }

    /**
     * Show the form for creating a new SomProjectsAdvisors.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return view('som_projects_advisors.create')->with('somProjectID',$request->input('som_project_id'));
    }
    /**
     * Store a newly created SomProjectsAdvisors in storage.
     *
     * @param CreateSomProjectsAdvisorsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsAdvisorsRequest $request)
    {
        $input = $request->all();

        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->create($input);

        Flash::success('Som Projects Advisors saved successfully.');

        return redirect(route('somProjectsAdvisors.index'));
    }

    /**
     * Display the specified SomProjectsAdvisors.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->find($id);

        if (empty($somProjectsAdvisors)) {
            Flash::error('Som Projects Advisors not found');

            return redirect(route('somProjectsAdvisors.index'));
        }

        return view('som_projects_advisors.show')->with('somProjectsAdvisors', $somProjectsAdvisors);
    }

    /**
     * Show the form for editing the specified SomProjectsAdvisors.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->find($id);

        if (empty($somProjectsAdvisors)) {
            Flash::error('Som Projects Advisors not found');

            return redirect(route('somProjectsAdvisors.index'));
        }

        return view('som_projects_advisors.edit')
            ->with('somProjectsAdvisors', $somProjectsAdvisors)
            ->with('somProjectID', $somProjectsAdvisors->som_projects_id); //0712
    }

    /**
     * Update the specified SomProjectsAdvisors in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsAdvisorsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsAdvisorsRequest $request)
    {
        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->find($id);

        if (empty($somProjectsAdvisors)) {
            Flash::error('Som Projects Advisors not found');

            return redirect(route('somProjectsAdvisors.index'));
        }

        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->update($request->all(), $id);

        Flash::success('Som Projects Advisors updated successfully.');

        return redirect(route('somProjectsAdvisors.index'));
    }

    /**
     * Remove the specified SomProjectsAdvisors from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsAdvisors = $this->somProjectsAdvisorsRepository->find($id);

        if (empty($somProjectsAdvisors)) {
            Flash::error('Som Projects Advisors not found');

            return redirect(route('somProjectsAdvisors.index'));
        }

        $this->somProjectsAdvisorsRepository->delete($id);

        Flash::success('Som Projects Advisors deleted successfully.');

        return redirect(route('somProjectsAdvisors.index'));
    }
}
