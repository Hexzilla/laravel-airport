<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomProjectsPartnersRequest;
use App\Http\Requests\UpdateSomProjectsPartnersRequest;
use App\Repositories\SomProjectsPartnersRepository;
use App\Repositories\SomProjectsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;

class SomProjectsPartnersController extends AppBaseController
{
    /** @var  SomProjectsPartnersRepository */
    private $somProjectsPartnersRepository;
    private $somProjectsRepository;

    public function __construct(SomProjectsPartnersRepository $somProjectsPartnersRepo,
                                SomProjectsRepository $somProjectsRepo)
    {
        $this->somProjectsPartnersRepository = $somProjectsPartnersRepo;
        $this->somProjectsRepository = $somProjectsRepo;
    }

    /**
     * Display a listing of the SomProjectsPartners.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {   
        if($request->input('project_id') == null){
            Flash::error('Som Projects Id not found');
            return redirect(route('somProjects.index'));
        }
        $somProjectsID = $request->input('project_id');
        $somProjects = $this->somProjectsRepository->find($somProjectsID);
        $breadcrumbs = array();
        $breadcrumbs[0] = array();
        $breadcrumbs[0]['id'] = $somProjects['id'];
        $breadcrumbs[0]['name'] = $somProjects['name'];

        if ($request->ajax()) {

            $data = $this->somProjectsPartnersRepository->all(['som_projects_id'=>$somProjectsID]);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    $action .= "<a href=\"".route('somProjectsPartners.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somProjectsPartners.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_projects_partners.index')
            ->with('somProjectID',$somProjectsID)
            ->with('breadcrumbs', $breadcrumbs);
    }

    /**
     * Show the form for creating a new SomProjectsPartners.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return view('som_projects_partners.create')->with('somProjectID', $request->input('som_project_id'));
    }
    /**
     * Store a newly created SomProjectsPartners in storage.
     *
     * @param CreateSomProjectsPartnersRequest $request
     *
     * @return Response
     */
    public function store(CreateSomProjectsPartnersRequest $request)
    {
        $input = $request->all();

        $somProjectsPartners = $this->somProjectsPartnersRepository->create($input);

        Flash::success('Som Projects Partners saved successfully.');

        return redirect(route('somProjectsPartners.index',['project_id'=> $input['som_projects_id']]));
    }

    /**
     * Display the specified SomProjectsPartners.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somProjectsPartners = $this->somProjectsPartnersRepository->find($id);

        if (empty($somProjectsPartners)) {
            Flash::error('Som Projects Partners not found');

            return redirect(route('somProjects.index'));
        }

        return view('som_projects_partners.show')->with('somProjectsPartners', $somProjectsPartners);
    }

    /**
     * Show the form for editing the specified SomProjectsPartners.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somProjectsPartners = $this->somProjectsPartnersRepository->find($id);

        if (empty($somProjectsPartners)) {
            Flash::error('Som Projects Partners not found');

            return redirect(route('somProjects.index'));
        }

        return view('som_projects_partners.edit')
            ->with('somProjectsPartners', $somProjectsPartners)
            ->with('somProjectID', $somProjectsPartners->som_projects_id);
    }

    /**
     * Update the specified SomProjectsPartners in storage.
     *
     * @param int $id
     * @param UpdateSomProjectsPartnersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomProjectsPartnersRequest $request)
    {
        $somProjectsPartners = $this->somProjectsPartnersRepository->find($id);

        if (empty($somProjectsPartners)) {
            Flash::error('Som Projects Partners not found');

            return redirect(route('somProjects.index'));
        }

        $somProjectsPartners = $this->somProjectsPartnersRepository->update($request->all(), $id);

        Flash::success('Som Projects Partners updated successfully.');

        return redirect(route('somProjectsPartners.index',['project_id'=> $somProjectsPartners['som_projects_id']]));
    }

    /**
     * Remove the specified SomProjectsPartners from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $somProjectsPartners = $this->somProjectsPartnersRepository->find($id);

        if (empty($somProjectsPartners)) {
            Flash::error('Som Projects Partners not found');

            return redirect(route('somProjects.index'));
        }

        $this->somProjectsPartnersRepository->delete($id);

        Flash::success('Som Projects Partners deleted successfully.');

        return redirect(route('somProjectsPartners.index',['project_id'=> $somProjectsPartners['som_projects_id']]));
    }
}
