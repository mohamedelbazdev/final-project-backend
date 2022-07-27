<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Dashboard\AdminsController;
use  App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProviderController;
use App\Http\Controllers\Dashboard\PaymentsController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\OrdersController;

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

Route::group(['middleware' =>['auth','auth.admin'] ], function () {
        Route::get('/dashboard', function () {
                return view('admin.index');
        })->name('dashboard');
        Route::resource('user', UserController::class);
        Route::resource('admins', AdminsController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('provider', ProviderController::class);
        Route::resource('payment', PaymentsController::class);
        Route::resource('orders', OrdersController::class);
        Route::get('/providers/inactive/{id}', [ProviderController::class,"Inactive"])->name('Inactive');
        Route::get('/providers/active/{id}', [ProviderController::class,"Active"])->name('Active');
});

// Account Setting Routes
Route::get('/account/setting', [AuthController::class, 'AccountSetting'])->name('account.setting');

Route::get('/profile/edit', [AuthController::class, 'ProfileEdit'])->name('profile.edit');

Route::post('/profile/store', [AuthController::class, 'ProfileStore'])->name('profile.store');

/// Change Password

Route::get('/show/password', [AuthController::class, 'ShowPassword'])->name('show.password');

Route::post('/change/password', [AuthController::class, 'ChangePassword'])->name('change.password');

//admin=======
Route::get('admin/home', [AuthController::class,'index']);
Route::get('admin/login', [AuthController::class,'showLoginForm'])->name('admin.showlogin')->middleware('guest');;
Route::post('admin/login', [AuthController::class,'customLogin'])->name('admin.login');
Route::get('admin/logout', [AuthController::class,'signOut'])->name('admin.logout');


