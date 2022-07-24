<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\CategroyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\OrderController;

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


// login admin
Route::post('auth/login', [AuthController::class, 'login']);

Route::apiResource('categories', CategroyController::class);


/** Chat Section */
Route::group(['middleware'=>['auth:sanctum'], 'prefix' => 'chats'], function(){
    Route::post('create_room', [ChatController::class, 'createRoom']);
    Route::get('my_rooms', [ChatController::class, 'myRooms']);
    Route::get('user/rooms/{userId}', [ChatController::class, 'userRooms']);
    Route::get('specific_room/{room_id}', [ChatController::class, 'specific_room']);
    Route::post('send_message', [ChatController::class, 'sendMessage']);
    Route::put('mark_as_read/{id}' , [ChatController::class, 'mark_as_read']);
    Route::get('delete_msg/{id}' , [ChatController::class, 'delete_msg']);
});

/** Chat Section */
Route::group(['middleware'=>['auth:sanctum'], 'prefix' => 'users'], function(){
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('profile/edit', [AuthController::class, 'updateProfile']);
    Route::get('categories', [CategroyController::class, 'index']);
    Route::get('providers', [UserController::class, 'providers']);
});





