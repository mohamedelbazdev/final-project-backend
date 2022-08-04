<?php

use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\CategroyController;
use App\Http\Controllers\Api\User\FavoriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\OrderController;
use App\Http\Controllers\Api\User\ChatController;
use App\Http\Controllers\Api\User\FeedbackController;
use App\Http\Controllers\Api\User\PaymentController;
use App\Http\Controllers\Api\User\RateController;
use App\Http\Controllers\Api\User\RateProviderController;
use App\Http\Controllers\Api\User\RateUserController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\User\ContactFormController;




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
    Route::post('create', [AuthController::class, 'storeUser']);
    Route::post('orders/create', [OrderController::class, 'store']);
    Route::apiResource('rateprovider',RateProviderController::class);
    Route::post('viewers', [RateProviderController::class, 'viewers']);
    Route::get('favorites', [FavoriteController::class, 'index']);
    Route::post('favorites/create', [FavoriteController::class, 'store']);
    Route::post('favorites/destroy', [FavoriteController::class, 'destroy']);
    Route::post('providers/details', [UserController::class, 'getProviderDetails']);
    Route::post('contact', [ContactFormController::class, 'ContactForm']);

});

/** Chat Section */
Route::group( ['prefix' => 'users'], function(){
    Route::get('categories', [CategroyController::class, 'index']);
    Route::get('providers', [UserController::class, 'providers']);
    Route::get('orders/sended', [OrderController::class, 'myOrders']);
    Route::get('orders/received', [OrderController::class, 'resivedOrders']);
});

/** Chat Section */
Route::group([ 'prefix' => 'providers'], function(){
    Route::post('register', [AuthController::class, 'storeUser']);
});





