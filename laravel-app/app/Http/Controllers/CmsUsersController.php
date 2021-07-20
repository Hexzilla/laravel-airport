<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCmsUsersRequest;
use App\Http\Requests\UpdateCmsUsersRequest;
use App\Repositories\CmsUsersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;

class CmsUsersController extends AppBaseController
{
    /** @var  CmsUsersRepository */
    private $cmsUsersRepository;

    public function __construct(CmsUsersRepository $cmsUsersRepo)
    {
        $this->cmsUsersRepository = $cmsUsersRepo;
    }

    /**
     * Display a listing of the CmsUsers.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = $this->cmsUsersRepository->all();
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
                ->editColumn('password', function ($request) {     
                    $password = "";
                    if(!empty($request->password)){
                        $password = $request->password;
                    }
                    return $password;  
                })
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    $action .= "<a href=\"".route('cmsUsers.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('cmsUsers.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('cms_users.index');
    }

    /**
     * Show the form for creating a new CmsUsers.
     *
     * @return Response
     */
    public function create()
    {
        return view('cms_users.create');
    }

    /**
     * Store a newly created CmsUsers in storage.
     *
     * @param CreateCmsUsersRequest $request
     *
     * @return Response
     */
    public function store(CreateCmsUsersRequest $request)
    {
        $input = $request->all();

        $cmsUsers = $this->cmsUsersRepository->create($input);

        Flash::success('Cms Users saved successfully.');

        return redirect(route('cmsUsers.index'));
    }

    /**
     * Display the specified CmsUsers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cmsUsers = $this->cmsUsersRepository->find($id);

        if (empty($cmsUsers)) {
            Flash::error('Cms Users not found');

            return redirect(route('cmsUsers.index'));
        }

        return view('cms_users.show')->with('cmsUsers', $cmsUsers);
    }

    /**
     * Show the form for editing the specified CmsUsers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cmsUsers = $this->cmsUsersRepository->find($id);

        if (empty($cmsUsers)) {
            Flash::error('Cms Users not found');

            return redirect(route('cmsUsers.index'));
        }

        return view('cms_users.edit')->with('cmsUsers', $cmsUsers);
    }

    /**
     * Update the specified CmsUsers in storage.
     *
     * @param int $id
     * @param UpdateCmsUsersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCmsUsersRequest $request)
    {
        $cmsUsers = $this->cmsUsersRepository->find($id);

        if (empty($cmsUsers)) {
            Flash::error('Cms Users not found');

            return redirect(route('cmsUsers.index'));
        }

        $cmsUsers = $this->cmsUsersRepository->update($request->all(), $id);

        Flash::success('Cms Users updated successfully.');

        return redirect(route('cmsUsers.index'));
    }

    /**
     * Remove the specified CmsUsers from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cmsUsers = $this->cmsUsersRepository->find($id);

        if (empty($cmsUsers)) {
            Flash::error('Cms Users not found');

            return redirect(route('cmsUsers.index'));
        }

        $this->cmsUsersRepository->delete($id);

        Flash::success('Cms Users deleted successfully.');

        return redirect(route('cmsUsers.index'));
    }
}
