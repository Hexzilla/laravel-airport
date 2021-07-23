<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateSomDepartmentsRequest;
use App\Http\Requests\UpdateSomDepartmentsRequest;
use App\Repositories\SomDepartmentsRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use Response;
use finfo;

use App\Http\Utils\SomLogger;

use DataTables;
use App\Http\Utils\CRUDBooster;

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

                    //button users                    
                    $action .= "<a href=\"".route("somDepartmentsUsers.index",['som_departments_id'=> $row->id])."\" class='btn btn-default btn-xs'><i class='fa fa-tasks'></i> Users</a>";

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
        }else{
            if (!CRUDBooster::isView()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_view",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
            }
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
        if (!CRUDBooster::isCreate()) {
            CRUDBooster::insertLog(trans('crudbooster.log_try_add', ['module'=>CRUDBooster::getCurrentModule()->name ]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans("crudbooster.denied_access"));
        }

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
        try{

            if(!CRUDBooster::isCreate()) {
                CRUDBooster::insertLog(trans('crudbooster.log_try_add_save',['module'=>CRUDBooster::getCurrentModule()->name ]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
            }

            $input = $request->all();
            $somDepartments = $this->somDepartmentsRepository->create($input);

        }catch(\Exception $e){
            SomLogger::error("ERR1003","Error SomDepartmentsController->store(): ".$e->getMessage());
            SomLogger::error("ERR1003",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somDepartments.index'));
        }
            
        CRUDBooster::insertLog(trans("crudbooster.log_add",['module'=>CRUDBooster::getCurrentModule()->name]));

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
        if (!CRUDBooster::isRead()) {
            CRUDBooster::insertLog(trans("crudbooster.log_try_view", ['module'=>CRUDBooster::getCurrentModule()->name]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

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
        if (!CRUDBooster::isRead()) {
            CRUDBooster::insertLog(trans("crudbooster.log_try_edit", ['module'=>CRUDBooster::getCurrentModule()->name]));
            CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
        }

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
        try{
            if(!CRUDBooster::isUpdate()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_update",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somDepartments = $this->somDepartmentsRepository->find($id);

            if (empty($somDepartments)) {
                Flash::error('Som Departments not found');

                return redirect(route('somDepartments.index'));
            }

            $somDepartments = $this->somDepartmentsRepository->update($request->all(), $id);
        }catch(\Exception $e){
            SomLogger::error("ERR1004","Error SomDepartmentsController->update(): ".$e->getMessage());
            SomLogger::error("ERR1004",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somDepartments.index'));
        }            

        CRUDBooster::insertLog(trans("crudbooster.log_update",['module'=>CRUDBooster::getCurrentModule()->name]));

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
        try{
            if(!CRUDBooster::isDelete()) {
                CRUDBooster::insertLog(trans("crudbooster.log_try_delete",['module'=>CRUDBooster::getCurrentModule()->name]));
                CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
            }

            $somDepartments = $this->somDepartmentsRepository->find($id);

            if (empty($somDepartments)) {
                Flash::error('Som Departments not found');

                return redirect(route('somDepartments.index'));
            }

            $this->somDepartmentsRepository->delete($id);
        }catch(\Exception $e){
            SomLogger::error("ERR1005","Error SomDepartmentsController->destroy(): ".$e->getMessage());
            SomLogger::error("ERR1005",$e->getTraceAsString());
            Flash::error($e->getMessage());
            return redirect(route('somDepartments.index'));
        }  
        CRUDBooster::insertLog(trans("crudbooster.log_delete",['module'=>CRUDBooster::getCurrentModule()->name]));
        Flash::success('Som Departments deleted successfully.');
        return redirect(route('somDepartments.index'));
    }

    /**
     * Load Deparments and User Info from LDAP
     */
    public function getLoad()
    {
        ini_set('max_execution_time', 1200); //300 seconds = 5 minutes

        try {
            SomLogger::info("MSG1007", "Start Load Users from Active Directory Group: " . env('LDAP_USERS_IMPORT_GROUP'));

            //Find groups Users:
            $query = Adldap::search()
                ->select(array('cn', 'displayname', 'userprincipalname', 'title', 'memberof', 'thumbnailphoto'))
                ->where('objectClass', '=', 'person')
                ->where('memberOf', '=', env('LDAP_USERS_IMPORT_GROUP'));

            $usersLdap = $query->get();

            //Iterate over users:
            SomLogger::debug("DBG1001", "Processing Users...");
            foreach ($usersLdap as $u) {

                $userName = $u['cn'][0];
                $userDisplayName = $u['displayname'][0];
                $userEmail = $u['userprincipalname'][0];
                $userTitle = $u['title'][0];
                $userPhoto = $u['thumbnailphoto'][0];
                //$userGroups=$u['memberof'];

                $userId = null;

                SomLogger::debug("DBG1001", "User:\t cn: {$userName}, displayname: {$userDisplayName}, userprincipalname: {$userEmail}, title: {$userTitle}");

                //If not exists user in DB
                $user = DB::table('cms_users')->where("email", $userEmail)->first();
                if ($user == null) {
                    SomLogger::debug("DBG1001", "Create user {$userName} - {$userEmail}");
                    //Create User
                    $newUser = [
                        'name' => $userName,
                        'email' => $userEmail,
                        //Default Role: GPI User
                        'id_cms_privileges' => 6,
                        'status' => 'Active',
                        'job_title' => $userTitle,
                    ];
                    $userId = DB::table('cms_users')->insertGetId($newUser);
                } else {
                    SomLogger::debug("DBG1001", "User {$userName} - {$userEmail} already exists");
                    $userId = $user->id;
                }

                //If get Photo info from LDAP
                if (strlen($userPhoto) > 50) {
                    SomLogger::debug("DBG1001", "Update user photo");
                    //Update user photo
                    $finfo = new finfo(FILEINFO_MIME);
                    $mime = $finfo->buffer($userPhoto);
                    $extension = explode(';', explode('/', $mime)[1])[0];

                    $file_path = "uploads/{$userId}/thumbnail";

                    Storage::makeDirectory($file_path);
                    $filename =  "user.{$extension}";
                    $photoUrl = "/{$file_path}/{$filename}";

                    Storage::put($file_path . "/" . $filename, $userPhoto);
                    DB::table('cms_users')->where("id", $userId)->update(['photo' => $photoUrl]);
                }
            }
        } catch (\Exception $e) {
            //TODO: Redirect with flash message
            //TODO: Redirect back to departments page
            Flash::error($e->getMessage());
            return redirect(route('somDepartments.index'));
        }
        Flash::success('The data import was successful.');
        return redirect(route('somDepartments.index'));
    }
}
