<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->resource('users', 'api\UsersController');

Route::middleware('auth:api')->resource('campuses', 'api\CampusesController');
Route::middleware('auth:api')->get('campuses/{campus}/programs', 'api\CampusesController@showCampusPrograms');

Route::middleware('auth:api')->resource('programs', 'api\ProgramsController');
Route::middleware('auth:api')->resource('programs-per-campuses', 'api\ProgramsPerCampusesController');

Route::middleware('auth:api')->get('order-by-name-programs', 'FrontendController@orderByNamePrograms');

Route::get('trash-campuses', 'api\TrashCampusesController@index');
Route::patch('trash-campuses/{id}', 'api\TrashCampusesController@restore');
Route::delete('trash-campuses/{id}', 'api\TrashCampusesController@destroy');

Route::get('trash-programs', 'api\TrashProgramsController@index');
Route::patch('trash-programs/{id}', 'api\TrashProgramsController@restore');
Route::delete('trash-programs/{id}', 'api\TrashProgramsController@destroy');

Route::get('trash-users', 'api\TrashUsersController@index');
Route::patch('trash-users/{id}', 'api\TrashUsersController@restore');
Route::delete('trash-users/{id}', 'api\TrashUsersController@destroy');

Route::middleware('auth:api')->resource('other-documents', 'api\OtherDocumentsController');