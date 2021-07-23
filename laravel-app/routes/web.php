<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EncryptController;
use App\Http\Controllers\FormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    AdminController::class, 'index'
])->name('admin');


Auth::routes();

Route::get('/admin', [
    AdminController::class, 'index'
])->name('admin');

Route::get('form/{id}', [App\Http\Controllers\FormController::class, 'load'], function ($id) {
    return $id;
});
Route::post('form/submit', [App\Http\Controllers\FormController::class, 'submit']);
Route::post('form/saveConsulted', [App\Http\Controllers\FormController::class, 'saveConsulted']);
Route::post('form/findUser', [App\Http\Controllers\FormController::class, 'findUser']);
Route::get('downloadDoc/{projectId}/{type}/{id}/{name}',[App\Http\Controllers\FormController::class, 'downloadFile']);
Route::get('/getLoad', [
    App\Http\Controllers\SomDepartmentsController::class, 'getLoad'
])->name('getLoad');

Route::resource('cmsApiCustoms', App\Http\Controllers\CmsApiCustomController::class);

Route::resource('cmsApiKeys', App\Http\Controllers\CmsApiKeyController::class);

Route::resource('cmsLogs', App\Http\Controllers\CmsLogsController::class);

Route::resource('cmsStatisticComponents', App\Http\Controllers\CmsStatisticComponentsController::class);

Route::resource('cmsStatistics', App\Http\Controllers\CmsStatisticsController::class);

Route::resource('cmsUsers', App\Http\Controllers\CmsUsersController::class);

Route::resource('cmsSettings', App\Http\Controllers\CmsSettingsController::class);

Route::resource('cmsPrivilegesRoles', App\Http\Controllers\CmsPrivilegesRolesController::class);

Route::resource('cmsPrivileges', App\Http\Controllers\CmsPrivilegesController::class);

Route::resource('cmsModuls', App\Http\Controllers\CmsModulsController::class);

Route::resource('cmsMenusPrivileges', App\Http\Controllers\CmsMenusPrivilegesController::class);

Route::resource('cmsMenuses', App\Http\Controllers\CmsMenusController::class);

Route::resource('cmsEmailTemplates', App\Http\Controllers\CmsEmailTemplatesController::class);

Route::resource('cmsEmailQueues', App\Http\Controllers\CmsEmailQueuesController::class);

Route::resource('cmsDashboards', App\Http\Controllers\CmsDashboardController::class);

Route::resource('cmsUsers', App\Http\Controllers\CmsUsersController::class);

Route::resource('somApprovalsResponsibles', App\Http\Controllers\SomApprovalsResponsibleController::class);

Route::resource('somCountries', App\Http\Controllers\SomCountryController::class);

Route::resource('somCountryInfos', App\Http\Controllers\SomCountryInfoController::class);

Route::resource('somDepartments', App\Http\Controllers\SomDepartmentsController::class);

Route::resource('somDepartmentsUsers', App\Http\Controllers\SomDepartmentsUsersController::class);

Route::resource('somFormApprovals', App\Http\Controllers\SomFormApprovalsController::class);

Route::resource('somFormElements', App\Http\Controllers\SomFormElementsController::class);

Route::resource('somFormTasks', App\Http\Controllers\SomFormTasksController::class);

Route::resource('somForms', App\Http\Controllers\SomFormsController::class);

Route::resource('somMilestonesFormsTypes', App\Http\Controllers\SomMilestonesFormsTypesController::class);

Route::resource('somNews', App\Http\Controllers\SomNewsController::class);

Route::resource('somPhases', App\Http\Controllers\SomPhasesController::class);

Route::resource('somProjectsMilestones', App\Http\Controllers\SomProjectsMilestonesController::class);

Route::resource('somPhasesMilestonesTypes', App\Http\Controllers\SomPhasesMilestonesTypesController::class);

Route::resource('somProjectInfoStatuses', App\Http\Controllers\SomProjectInfoStatusController::class);

Route::resource('somProjectProcessTypes', App\Http\Controllers\SomProjectProcessTypeController::class);

Route::resource('somProjectUsers', App\Http\Controllers\SomProjectUsersController::class);

Route::resource('somProjects', App\Http\Controllers\SomProjectsController::class);

Route::resource('somProjectsAdditionalAirports', App\Http\Controllers\SomProjectsAdditionalAirportController::class);

Route::resource('somProjectsAdvisors', App\Http\Controllers\SomProjectsAdvisorsController::class);

Route::resource('somAirports', App\Http\Controllers\SomProjectsAirportController::class);

Route::resource('somProjectsAirports', App\Http\Controllers\SomProjectsAirportController::class);

Route::resource('somProjectsAirportTypes', App\Http\Controllers\SomProjectsAirportTypeController::class);

Route::resource('somProjectsAssetTypes', App\Http\Controllers\SomProjectsAssetTypeController::class);

Route::resource('somProjectsModels', App\Http\Controllers\SomProjectsModelController::class);

Route::resource('somProjectsPartners', App\Http\Controllers\SomProjectsPartnersController::class);

Route::resource('somProjectsPhases', App\Http\Controllers\SomProjectsPhasesController::class);

Route::resource('somProjectsPriorities', App\Http\Controllers\SomProjectsPriorityController::class);

Route::resource('somProjectsTransactionTypes', App\Http\Controllers\SomProjectsTransactionTypeController::class);

Route::resource('somStatuses', App\Http\Controllers\SomStatusController::class);

Route::resource('somStatusApprovals', App\Http\Controllers\SomStatusApprovalsController::class);

Route::resource('home', App\Http\Controllers\HomeController::class);

Route::get('/api/get_project', [App\Http\Controllers\ApiGetProjectController::class, 'index'])->name('get_project');
Route::get('/api/news', [App\Http\Controllers\ApiNewsController::class, 'index'])->name('get_news');
