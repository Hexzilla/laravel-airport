<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectUsersRequest;
use App\Http\Requests\UpdateSomProjectUsersRequest;
use App\Repositories\SomProjectUsersRepository;
use App\Repositories\SomProjectsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DataTables;

class SomProjectUsersController extends AppBaseController
{
    /** @var  SomProjectUsersRepository */
    private $somProjectUsersRepository;
    private $somProjectsRepository;

    public function __construct(SomProjectUsersRepository $somProjectUsersRepo,
                                SomProjectsRepository $somProjectsRepo)
    {
        $this->somProjectUsersRepository = $somProjectUsersRepo;
        $this->somProjectsRepository = $somProjectsRepo;  
    }

    /**
     * Display a listing of the SomProjectUsers.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $project_id = $request->input('project_id');

        $somProjects = $this->somProjectsRepository->find($project_id);
        $breadcrumbs = array();
        $breadcrumbs[0] = array();
        $breadcrumbs[0]['id'] = $somProjects['id'];
        $breadcrumbs[0]['name'] = $somProjects['name'];

        if ($request->ajax()) {

            $data = $this->somProjectUsersRepository->all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    $action .= "<a href=\"".route('somProjectUsers.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somProjectUsers.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_project_users.index')
                    ->with('project_id', $project_id)
                    ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomProjectUsers.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $project_id = $request->input('project_id');
        return view('som_project_users.create')
                    ->with('project_id', $project_id);
    }

    /**
     * Store a newly created SomProjectUsers in storage.
     *
     * @param CreateSomProjectUsersRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectUsersRequest $request)
    {
        $input = $request->all();

        $somProjectUsers = $this->somProjectUsersRepository->create($input);

        Flash::success('Som Project Users saved successfully.');

        return redirect(route('somProjectUsers.index'));
    }

    /**
     * Display the specified SomProjectUsers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectUsers = $this->somProjectUsersRepository->find($id);

        if (empty($somProjectUsers)) {
            Flash::error('Som Project Users not found');

            return redirect(route('somProjectUsers.index'));
        }

        return view('som_project_users.show')->with('somProjectUsers', $somProjectUsers);
    }

    /**
     * Show the form for editing the specified SomProjectUsers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectUsers = $this->somProjectUsersRepository->find($id);

        if (empty($somProjectUsers)) {
            Flash::error('Som Project Users not found');

            return redirect(route('somProjectUsers.index'));
        }

        return view('som_project_users.edit')
                ->with('somProjectUsers', $somProjectUsers)
                ->with('project_id',$somProjectUsers->som_projects_id);
    }

    /**
     * Update the specified SomProjectUsers in storage.
     *
     * @param int $id
     * @param UpdateSomProjectUsersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectUsersRequest $request)
    {
        $somProjectUsers = $this->somProjectUsersRepository->find($id);

        if (empty($somProjectUsers)) {
            Flash::error('Som Project Users not found');

            return redirect(route('somProjectUsers.index'));
        }

        $somProjectUsers = $this->somProjectUsersRepository->update($request->all(), $id);

        Flash::success('Som Project Users updated successfully.');

        return redirect(route('somProjectUsers.index'));
    }

    /**
     * Remove the specified SomProjectUsers from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectUsers = $this->somProjectUsersRepository->find($id);

        if (empty($somProjectUsers)) {
            Flash::error('Som Project Users not found');

            return redirect(route('somProjectUsers.index'));
        }

        $this->somProjectUsersRepository->delete($id);

        Flash::success('Som Project Users deleted successfully.');

        return redirect(route('somProjectUsers.index'));
    }
}
