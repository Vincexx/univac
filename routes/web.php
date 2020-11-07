<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', 'FrontendController@showAllCampuses')->name('homepage');
Route::middleware('auth')->get('/campus/{campus}/programs', 'FrontendController@showCampusPrograms')->name('campusPrograms');

Auth::routes(); 

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('authAdmin')->get('admin/{any}', function () {
    return view('admin.dashboard');
})->where('any', '[\/\w\.-]*')->name('admin-dashboard');

Route::post('logout', function() {

    if(Auth::check()){
        Auth::user()->forceFill([
            'api_token' => null,
        ])->save();
        Auth::logout();
        return redirect(route('homepage'));
    }

})->name('logout');

Route::get('about', 'FrontendController@about')->name('about');

