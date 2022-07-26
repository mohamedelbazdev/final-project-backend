<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProviderController;
use App\Http\Controllers\Dashboard\PaymentsController;

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
    return view('admin.index');
})->name('dashboard');

Route::resource('user', UserController::class);
Route::resource('category', CategoryController::class);
Route::resource('provider', ProviderController::class);
Route::resource('payment', PaymentsController::class);
Route::get('/providers/inactive/{id}', [ProviderController::class,"Inactive"])->name('Inactive');
Route::get('/providers/active/{id}', [ProviderController::class,"Active"])->name('Active');
