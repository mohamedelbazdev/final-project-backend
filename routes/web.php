<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProviderController;

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
Route::get('/',function(){
return view('welcome');
});
Route::get('/dashboard', function () {
    return view('admin.admin_master');
});

Route::resource('user', UserController::class);
Route::resource('category', CategoryController::class);
Route::resource('provider', ProviderController::class);
