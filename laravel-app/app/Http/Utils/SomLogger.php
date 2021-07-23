<?php

namespace App\Http\Utils;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class SomLogger{

    public static $codeEvents = [
        "MSG1001" => "ProjectsNotFound",//"No encontramos proyectos",
        "MSG1002" => "CheckSharepoint",//"Get SharepointOnPrem credentials for use",
        "MSG1004" => "ApiSendnotifications",//"ApiSendnotificationsController: User: {$user['id']}, Type: {$postdata['type']}",
        "MSG1005" => "SubmitFormInfo",//"Submit data...",
        "MSG1006" => "UserLogout",//User '{$me->name}' has been logged out"
        "MSG1007" => "LoadUsersAD",//Start Load Users from Active Directory
        "MSG1008" => "EmailSent", //"Failed upload file to Sharepoint folder
        "DBG1001" => "DebugMessage",
        "DBG1002" => "SharepointCredentials",
        "ERR1001" => "ErrorInternal",//"Dont have user info",
        "ERR1002" => "ErrorLoginSharepoint",// "User  cant login into Sharepoint",
        "ERR1003" => "ErrorSaveInfo",//"Error SOMController->postEditSave()",
        "ERR1004" => "ErrorEditInfo",//"Error SOMController->postAddSave()",
        "ERR1005" => "ErrorDeleteInfo",//"Error SOMController->getDelete()",
        "ERR1006" => "ErrorDeleteImage",//"Error SOMController->getDeleteImage()",
        "ERR1007" => "ErrorForm",//,"Not found Form Info",
        "ERR1008" => "ErrorFormUnauthorized",//"Trying to access unauthorized form",
        "ERR1008" => "ErrorSharepointProject", //"Project {$projectId} doesn't have any sharepoint folder configured",
        "ERR1009" => "ErrorUser",//"Dont have user info",
        "ERR1010" => "ErrorUserNotLogged",//User not logged
        "ERR1011" => "ErrorSharepointConnection",//"Error connecting to Sharepoint"
        "ERR1012" => "ErrorSharepointUpload", //"Failed upload file to Sharepoint folder
        "ERR1013" => "ErrorSharepointDownload", //"Failed upload file to Sharepoint folder
        "ERR1014" => "ErrorSendingEMail", //"Failed upload file to Sharepoint folder
        
        "" => "No_Aportado"
    ];


    public static function info($code, $message){
        $maquinaOrigen=request()->ip();
        $maquinaDetino=request()->server('SERVER_ADDR');
        
        $userOrigen=Session::get('admin_id');
        if($userOrigen==null){
            $userOrigen="No_Aportado";
        }
        $userDestino="No_Aportado";

        $event="No_Aportado";

        if($code!=null){
            $event = SomLogger::$codeEvents[$code];
        }

        Log::info("-fuente: GPI -maquina-origen: ${maquinaOrigen} -maquina_destino: ${maquinaDetino} -usuario: {$userOrigen} -usuario_dest: {$userDestino} -code: {$code} -evento: {$event} -texto: {$message}");
    }

    public static function debug($code, $message){
        $maquinaOrigen=request()->ip();
        $maquinaDetino=request()->server('SERVER_ADDR');
        
        $userOrigen=Session::get('admin_id');
        if($userOrigen==null){
            $userOrigen="No_Aportado";
        }
        $userDestino="No_Aportado";

        $event="No_Aportado";

        if($code!=null){
            $event = SomLogger::$codeEvents[$code];
        }

        Log::debug("-fuente: GPI -maquina-origen: ${maquinaOrigen} -maquina_destino: ${maquinaDetino} -usuario: {$userOrigen} -usuario_dest: {$userDestino} -code: {$code} -evento: {$event} -texto: {$message}");
    }

    public static function error($code, $message){
        $maquinaOrigen=request()->ip();
        $maquinaDetino=request()->server('SERVER_ADDR');
        
        $userOrigen=Session::get('admin_id');
        if($userOrigen==null){
            $userOrigen="No_Aportado";
        }
        $userDestino="No_Aportado";

        $event="No_Aportado";

        if($code!=null){
            $event = SomLogger::$codeEvents[$code];
        }

        Log::error("-fuente: GPI -maquina-origen: ${maquinaOrigen} -maquina_destino: ${maquinaDetino} -usuario: {$userOrigen} -usuario_dest: {$userDestino} -code: {$code} -evento: {$event} -texto: {$message}");
    }
}