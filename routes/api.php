<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\CategroyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\OrderController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\CategroyController;
use App\Http\Controllers\Api\Admin\ChatController;
use App\Http\Controllers\Api\Admin\FeedbackController;
use App\Http\Controllers\Api\Admin\PaymentController;
use App\Http\Controllers\Api\Admin\RateController;
use App\Http\Controllers\Api\Admin\RateProviderController;
use App\Http\Controllers\Api\Admin\RateUserController;
use App\Http\Controllers\Api\Admin\UserController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

<<<<<<< HEAD
// login admin
Route::post('login', [AuthController::class, 'login']);

Route::apiResource('categories', CategroyController::class);
=======
Route::group(['namespace' => 'Api'], function () {




});
>>>>>>> f991c6a7c5b7e9b4192cd9f2d8296b6ede4aa035
