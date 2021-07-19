<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomDepartmentsRequest;
use App\Http\Requests\UpdateSomDepartmentsRequest;
use App\Repositories\SomDepartmentsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;

class SomDepartmentsController extends AppBaseController
{
    /** @var  SomDepartmentsRepository */
    private $somDepartmentsRepository;

    public function __construct(SomDepartmentsRepository $somDepartmentsRepo)
    {
        $this->somDepartmentsRepository = $somDepartmentsRepo;
    }

    /**
     * Display a listing of the SomDepartments.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = $this->somDepartmentsRepository->all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    $action .= "<a href=\"".route('somDepartments.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somDepartments.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_departments.index');
    }

    /**
     * Show the form for creating a new SomDepartments.
     *
     * @return Response
     */
    public function create()
    {
        return view('som_departments.create');
    }

    /**
     * Store a newly created SomDepartments in storage.
     *
     * @param CreateSomDepartmentsRequest $request
     *
     * @return Response
     */
    public function store(CreateSomDepartmentsRequest $request)
    {
        $input = $request->all();

        $somDepartments = $this->somDepartmentsRepository->create($input);

        Flash::success('Som Departments saved successfully.');

        return redirect(route('somDepartments.index'));
    }

    /**
     * Display the specified SomDepartments.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somDepartments = $this->somDepartmentsRepository->find($id);

        if (empty($somDepartments)) {
            Flash::error('Som Departments not found');

            return redirect(route('somDepartments.index'));
        }

        return view('som_departments.show')->with('somDepartments', $somDepartments);
    }

    /**
     * Show the form for editing the specified SomDepartments.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somDepartments = $this->somDepartmentsRepository->find($id);

        if (empty($somDepartments)) {
            Flash::error('Som Departments not found');

            return redirect(route('somDepartments.index'));
        }

        return view('som_departments.edit')->with('somDepartments', $somDepartments);
    }

    /**
     * Update the specified SomDepartments in storage.
     *
     * @param int $id
     * @param UpdateSomDepartmentsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomDepartmentsRequest $request)
    {
        $somDepartments = $this->somDepartmentsRepository->find($id);

        if (empty($somDepartments)) {
            Flash::error('Som Departments not found');

            return redirect(route('somDepartments.index'));
        }

        $somDepartments = $this->somDepartmentsRepository->update($request->all(), $id);

        Flash::success('Som Departments updated successfully.');

        return redirect(route('somDepartments.index'));
    }

    /**
     * Remove the specified SomDepartments from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somDepartments = $this->somDepartmentsRepository->find($id);

        if (empty($somDepartments)) {
            Flash::error('Som Departments not found');

            return redirect(route('somDepartments.index'));
        }

        $this->somDepartmentsRepository->delete($id);

        Flash::success('Som Departments deleted successfully.');

        return redirect(route('somDepartments.index'));
    }
}
