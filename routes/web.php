<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Dashboard\AdminsController;
use  App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProviderController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\PaymentsController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\OrdersController;
use App\Http\Controllers\Dashboard\ContactControler;

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
     // return view('welcome');
     return redirect()->route('dashboard');
});

Route::group(['middleware' =>['auth','auth.admin'] ], function () {
        Route::get('/dashboard', function () {
                return view('admin.index');
        })->name('dashboard');
        Route::resource('user', UserController::class, ['except' => [
        'create'
        ]]);
        Route::get('/create/user', [UserController::class, 'create'])->name('user.create');

        Route::resource('admins', AdminsController::class, ['except' => [
        'create'
        ]]);
         Route::get('/create/admins', [AdminsController::class, 'create'])->name('admins.create');
        Route::resource('provider', ProviderController::class, ['except' => [
        'create'
        ]]);
         Route::get('/create/provider', [ProviderController::class, 'create'])->name('provider.create');
        Route::resource('category', CategoryController::class, ['except' => [
        'create'
        ]]);
        Route::get('/create/category', [CategoryController::class, 'create'])->name('category.create');

        Route::resource('slider', SliderController::class, ['except' => [
                'create'
                ]]);
                Route::get('/create/slider', [SliderController::class, 'create'])->name('slider.create');



        Route::resource('payment', PaymentsController::class);
        Route::resource('orders', OrdersController::class);
        Route::get('/providers/inactive/{id}', [ProviderController::class,"Inactive"])->name('Inactive');
        Route::get('/providers/active/{id}', [ProviderController::class,"Active"])->name('Active');
        Route::get('/user/inactive/{id}', [UserController::class,'Inactive'])->name('InactiveUser');
        Route::get('/user/active/{id}', [UserController::class,'Active'])->name('ActiveUser');
        Route::get('contact-us', [ContactControler::class, 'index']);
        Route::post('contact-us', [ContactControler::class, 'store'])->name('contact.us.store');
        Route::get('allConatcts',[ContactControler::class, 'allContactMessages'])->name('contacts.all');
});



//admin=======
Route::group(['middleware' =>['auth','auth.admin'] ], function(){
    Route::get('admin/home', [AuthController::class,'index']);
    // Account Setting Routes
Route::get('/account/setting', [AuthController::class, 'AccountSetting'])->name('account.setting');

Route::get('/profile/edit', [AuthController::class, 'ProfileEdit'])->name('profile.edit');

Route::post('/profile/store', [AuthController::class, 'ProfileStore'])->name('profile.store');

/// Change Password

Route::get('/show/password', [AuthController::class, 'ShowPassword'])->name('show.password');

Route::post('/change/password', [AuthController::class, 'ChangePassword'])->name('change.password');
});

Route::get('admin/login', [AuthController::class,'showLoginForm'])->name('admin.showlogin')->middleware('guest');;
Route::post('admin/login', [AuthController::class,'customLogin'])->name('admin.login');
Route::get('admin/logout', [AuthController::class,'signOut'])->name('admin.logout');


