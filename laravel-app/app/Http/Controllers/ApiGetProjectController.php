<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ApiGetProjectController extends Controller
{
    public function index(Request $request){
        // return json_encode('test api request');
        $project_id = $request->get('id', 46);
        $user_id = Auth::id();

        return $user_id;
    }
}
