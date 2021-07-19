<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSomDepartmentsUsersRequest;
use App\Http\Requests\UpdateSomDepartmentsUsersRequest;
use App\Repositories\SomDepartmentsUsersRepository;
use App\Repositories\CmsUsersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DataTables;

class SomDepartmentsUsersController extends AppBaseController
{
    /** @var  SomDepartmentsUsersRepository */
    private $somDepartmentsUsersRepository;
    private $cmsUsersRepository;

    public function __construct(SomDepartmentsUsersRepository $somDepartmentsUsersRepo,
                                CmsUsersRepository $cmsUsersRepository)
    {
        $this->somDepartmentsUsersRepository = $somDepartmentsUsersRepo;
        $this->cmsUsersRepository = $cmsUsersRepository;
    }

    /**
     * Display a listing of the SomDepartmentsUsers.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $som_departments_id = $request->get("som_departments_id");

        if ($request->ajax()) {

            $data = $this->somDepartmentsUsersRepository->getAllData($som_departments_id);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $action ="";
                    $action .= "<div class='btn-group' style='float:right;'>";

                    //button show                
                    $action .= "<a href=\"".route('somDepartmentsUsers.show', [$row->id])."\" class='btn btn-default btn-xs'>";
                    $action .= "<i class='far fa-eye'></i>";
                    $action .= "</a>";   

                    //button edit                     
                    $action .= "<a href=\"".route('somDepartmentsUsers.edit', [$row->id])."\" class='btn btn-default btn-xs'>";
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

        return view('som_departments_users.index')
            ->with('som_departments_id', $som_departments_id);
    }

    /**
     * Show the form for creating a new SomDepartmentsUsers.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $som_departments_id = $request->get("som_departments_id");

        $data['users'] = array();
        $cmsUsers = $this->cmsUsersRepository->all();
        $cnt = 0;
        $selected_country_id = 0;
        foreach ($cmsUsers as $cmsuser) {
            $data['users'][$cmsuser->id] = $cmsuser->name;
            if($cnt == 0){
                $selected_user_id = $cmsuser->id;
            }
            $cnt++;
        }  
        $data['selected_user'] = $selected_user_id;

        return view('som_departments_users.create')
                    ->with('som_departments_id',$som_departments_id)
                    ->with('data',$data);
    }

    /**
     * Store a newly created SomDepartmentsUsers in storage.
     *
     * @param CreateSomDepartmentsUsersRequest $request
     *
     * @return Response
     */
    public function store(CreateSomDepartmentsUsersRequest $request)
    {
        $input = $request->all();
        $som_departments_id = $request->input('som_departments_id');  
        $cms_users_id = $request->input('cms_users_id');  

        $countDepartments = $this->somDepartmentsUsersRepository->getCountEqualData($som_departments_id, $cms_users_id);
        if($countDepartments>0){
            Flash::error('User already exist.');
            return redirect(route('somDepartmentsUsers.index',['som_departments_id'=> $som_departments_id]));
        }      

        $somDepartmentsUsers = $this->somDepartmentsUsersRepository->create($input);

        Flash::success('Som Departments Users saved successfully.');

        // return redirect(route('somDepartmentsUsers.index'));
        if(!empty($request->input('sub1'))){ //save
            return redirect(route('somDepartmentsUsers.index',['som_departments_id'=> $som_departments_id]));
        }else{ //save and more add
            return redirect(route('somDepartmentsUsers.create',['som_departments_id'=> $som_departments_id]));
        } 
    }

    /**
     * Display the specified SomDepartmentsUsers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $somDepartmentsUsers = $this->somDepartmentsUsersRepository->getData($id);

        if (empty($somDepartmentsUsers)) {
            Flash::error('Som Departments Users not found');

            return redirect(route('somDepartmentsUsers.index'));
        }

        $som_departments_id = $somDepartmentsUsers->som_departments_id;

        return view('som_departments_users.show')
                ->with('som_departments_id', $som_departments_id)
                ->with('somDepartmentsUsers', $somDepartmentsUsers);
    }

    /**
     * Show the form for editing the specified SomDepartmentsUsers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $somDepartmentsUsers = $this->somDepartmentsUsersRepository->find($id);

        if (empty($somDepartmentsUsers)) {
            Flash::error('Som Departments Users not found');

            return redirect(route('somDepartmentsUsers.index'));
        }

        $data['users'] = array();
        $cmsUsers = $this->cmsUsersRepository->all();
        $selected_country_id = 0;
        foreach ($cmsUsers as $cmsuser) {
            $data['users'][$cmsuser->id] = $cmsuser->name;
        }  
        $selected_user_id = $somDepartmentsUsers->cms_users_id;
        $data['selected_user'] = $selected_user_id;

        return view('som_departments_users.edit')
                    ->with('som_departments_id',$somDepartmentsUsers->som_departments_id)
                    ->with('data',$data)
                    ->with('somDepartmentsUsers', $somDepartmentsUsers);
    }

    /**
     * Update the specified SomDepartmentsUsers in storage.
     *
     * @param int $id
     * @param UpdateSomDepartmentsUsersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSomDepartmentsUsersRequest $request)
    {
        $somDepartmentsUsers = $this->somDepartmentsUsersRepository->find($id);
        $som_departments_id = $request->input('som_departments_id');  
        $cms_users_id = $request->input('cms_users_id'); 

        if (empty($somDepartmentsUsers)) {
            Flash::error('Som Departments Users not found');

            return redirect(route('somDepartmentsUsers.index',['som_departments_id'=> $som_departments_id]));
        }

        $countDepartments = $this->somDepartmentsUsersRepository->getCountEqualDataById($som_departments_id, $cms_users_id, $id);
        if($countDepartments>0){
            Flash::error('User already exist.');
            return redirect(route('somDepartmentsUsers.index',['som_departments_id'=> $som_departments_id]));
        }      

        $somDepartmentsUsers = $this->somDepartmentsUsersRepository->update($request->all(), $id);

        Flash::success('Som Departments Users updated successfully.');

        return redirect(route('somDepartmentsUsers.index',['som_departments_id'=> $som_departments_id]));
    }

    /**
     * Remove the specified SomDepartmentsUsers from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        $somDepartmentsUsers = $this->somDepartmentsUsersRepository->find($id);
        $som_departments_id = $request->input('som_departments_id');  

        if (empty($somDepartmentsUsers)) {
            Flash::error('Som Departments Users not found');

            return redirect(route('somDepartmentsUsers.index',['som_departments_id'=> $som_departments_id]));
        }
        $this->somDepartmentsUsersRepository->delete($id);

        Flash::success('Som Departments Users deleted successfully.');

        return redirect(route('somDepartmentsUsers.index',['som_departments_id'=> $som_departments_id]));
    }
}
