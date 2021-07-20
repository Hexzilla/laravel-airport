<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;

class CmsDashboardController extends AppBaseController
{

    /**
     * Display a listing of the CmsDashboard.
     *
     */
    public function index()
    {
        return view('cms_dashboards.index');
    }
}
