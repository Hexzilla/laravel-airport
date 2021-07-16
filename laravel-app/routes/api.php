<?php

use App\Http\Controllers\ApiGetProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SomNewsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function () {
    Route::get('/news', [SomNewsController::class, 'news']);
});

Route::get('encrypt/{text}', [App\Http\Controllers\EncryptController::class, 'encrypt'], function ($text) {
    return $text;
});



