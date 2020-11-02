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

Route::resource('users', 'api\UsersController');

Route::resource('campuses', 'api\CampusesController');
Route::get('campuses/{campus}/programs', 'api\CampusesController@showCampusPrograms');

Route::resource('programs', 'api\ProgramsController');
Route::resource('programs-per-campuses', 'api\ProgramsPerCampusesController');

Route::get('trash-campuses', 'api\TrashCampusesController@index');
Route::patch('trash-campuses/{id}', 'api\TrashCampusesController@restore');
Route::delete('trash-campuses/{id}', 'api\TrashCampusesController@destroy');

Route::get('trash-programs', 'api\TrashProgramsController@index');
Route::patch('trash-programs/{id}', 'api\TrashProgramsController@restore');
Route::delete('trash-programs/{id}', 'api\TrashProgramsController@destroy');