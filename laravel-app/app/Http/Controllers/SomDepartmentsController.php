<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateSomDepartmentsRequest;
use App\Http\Requests\UpdateSomDepartmentsRequest;
use App\Repositories\SomDepartmentsRepository;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\DB;
use Response;
use finfo;

use App\Http\Utils\SomLogger;

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
        $somDepartments = $this->somDepartmentsRepository->all();

        return view('som_departments.index')
            ->with('somDepartments', $somDepartments);
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

                $user = DB::table('cms_users')->where("email", $userEmail)->first();

                //If not exists user in DB
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
            return redirect(str_replace('/load','', request()->fullUrl()));
            //CRUDBooster::redirect(str_replace('/load','',Request::fullUrl()), trans('crudbooster.denied_privilege').$e->getMessage());
        }

        //$alertType = "success";
        //TODO: Redirect back to departments page
        //TODO: Redirect with flash message
        Flash::success('The data import was successful.');
        return redirect(str_replace('/load','', request()->fullUrl()));
        //CRUDBooster::redirect(str_replace('/load','',Request::fullUrl()), trans('crudbooster.alert_add_data_success'), $alertType);
    }
}
