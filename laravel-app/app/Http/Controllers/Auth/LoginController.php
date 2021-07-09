<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RqFacade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Adldap\Laravel\Facades\Adldap;
use finfo;

//use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
//use Office365\PHP\Client\Runtime\Auth\NetworkCredentialContext;

use App\Http\Utils\SomLogger;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //Rol Inactive ID
        $rolInactive = 2;

        echo json_encode($user);
        die();
        //If users exists and not is inactive can login
        if($user!=null && $user->id_cms_privileges!=$rolInactive){
            //TODO: Sharepoint logic
            //Get Sharepoint Token
            // $sharepointUrl=env('SHAREPOINT_URL');
            // $sharepointOnPrem=env('SHAREPOINT_ON_PREM');

            // try{

            //     if($sharepointOnPrem){
            //         list($log_user, $log_domain) = explode('@', $request->email);
            //         list($domain_auth, $dumb) = explode('.', $log_domain);
            //         //$sp_user="aena.es\\".str_replace("@aena.es", "", $request->email);
            //         $sp_user="{$domain_auth}\\{$log_user}";
            //         SomLogger::debug("DBG1002", "Check SharepointOnPrem credentials for user: {$sp_user}");
            //         $authCtx = new NetworkCredentialContext($sp_user, $request->password);
            //         Session::put("SharepointAuthCtx", Crypt::encrypt($authCtx));
            //     }
            //     else{
            //         SomLogger::debug("DBG1002", "Check Sharepoint credentials for user: {$request->email}");
            //         $authCtx = new AuthenticationContext($sharepointUrl);
            //         $authCtx->acquireTokenForUser($request->email, $request->password);
            //         Session::put("SharepointAuthCtx", Crypt::encrypt($authCtx));
            //     }

            // }
            // catch (\Exception $e) {
            //     SomLogger::error("ERR1002", "User {$request->email} cant login into Sharepoint");
            //     Session::put("SharepointAuthCtx", null);
            // }

            $priv = DB::table("cms_privileges")->where("id",$user->id_cms_privileges)->first();
            if (ISSET($user->photo)) {
                $user->photo = $photurl;
            }

            $roles = DB::table('cms_privileges_roles')
            ->where('id_cms_privileges',$user->id_cms_privileges)
            ->join('cms_moduls','cms_moduls.id','=','id_cms_moduls')
            ->select('cms_moduls.name','cms_moduls.path','is_visible','is_create','is_read','is_edit','is_delete')
            ->get();

            //TODO: Debug, this is failing authentication
            // Searching for a user:
            $usersLdap = Adldap::search()->where('userprincipalname', '=', $user->email)->get();
            echo json_encode($usersLdap);
            die();

            if($usersLdap!=null && $usersLdap[0] != null){
                //Save photo
                $photo_img = $usersLdap[0]->thumbnailphoto[0];

                if(strlen($photo_img)>50){
                    $finfo = new finfo(FILEINFO_MIME);
                    $mime = $finfo->buffer($photo_img);
                    $extension = explode(';',explode('/', $mime )[1])[0];

                    $file_path = "uploads/{$user->id}/thumbnail";

                    Storage::makeDirectory($file_path);
                    $filename =  "user.{$extension}";
                    $photo_url = "/{$file_path}/{$filename}";

                    Storage::put($file_path."/".$filename, $photo_img);
                    DB::table('cms_users')->where("id",$user->id)->update(['photo' => $photo_url]);
                }

                //Load user info into session
                Session::put('admin_id',$user->id);
                Session::put('admin_is_superadmin',$priv->is_superadmin);
                Session::put('admin_name',$user->name);
                Session::put('admin_photo',$photo_url);
                Session::put('admin_privileges_roles',$roles);
                Session::put("admin_privileges",$user->id_cms_privileges);
                Session::put('admin_privileges_name',$priv->name);
                Session::put('admin_lock',0);
                Session::put('theme_color',$priv->theme_color);
                Session::put("appname", $_ENV['appname']);
                Session::put("last_login_timestamp",Carbon::now()->timestamp);

                //CRUDBooster::insertLog(trans("crudbooster.log_login",['email'=>$user->email,'ip'=>RqFacade::server('REMOTE_ADDR')]));

                //Check redirect to Front or Backoffice
                $loginadmin = Session::get('loginadmin');

                if($loginadmin == null || $loginadmin==false){
                    echo "<script type='text/javascript'>window.top.location='/admin';</script>";
                    return redirect('/admin');
                } else {
                    echo "<script type='text/javascript'>window.top.location='".$redirectTo."';</script>";
                    return redirect($redirectTo);
                }

            }
            //Dont have user info-> return error
            else {

                SomLogger::error("ERR1009", "User info not found");
                return redirect('/login');
            }
        }
        else{

            SomLogger::error("ERR1009", "User info not found");
            return redirect('/login');
        }
    }

    public function maxAttempts()
    {
        return env('LOGIN_MAX_ATTEMPTS', 5);
    }

    public function decayMinutes()
    {
        return env('LOGIN_DECAY_MINUTES', 1);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
