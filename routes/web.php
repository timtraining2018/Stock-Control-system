<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;

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


// add language swith route
Route::get('setlocale/{locale}',function($lang){
    Session::put('locale',$lang);
    return redirect()->back();   
})->name('lang.switch');

// add all routes related to language switch in this language middleware
Route::group(['middleware'=>'language'],function ()
{
    //your translation routes
    Route::get('/', function () {
        return view('welcome');
    });
    
    Auth::routes();
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::group(['middleware' => ['auth']], function() {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('companies', CompanyController::class);
    });

});

Route::get('/audits', [App\Http\Controllers\AuditController::class, 'index'])->middleware('auth', \App\Http\Middleware\AllowOnlyAdmin::class);