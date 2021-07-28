<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InterestController;
use App\Http\Controllers\UserController;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'authenticate']);

Route::group(['middleware' => ['jwt.verify']], function () {
    //User
    Route::get('user', [UserController::class, 'getAuthenticatedUser']);

    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{user}', [UserController::class, 'show']);
    Route::post('users/{user}', [UserController::class, 'update']);

    //Rutas para messages
    Route::get('messages', [MessageController::class, 'index']);
    Route::get('messages/{message}', [MessageController::class, 'show']);
    Route::post('messages', [MessageController::class, 'store']);
    Route::delete('messages/{message}', [MessageController::class, 'delete']);

    //Chat
    Route::get('user/{user}/chats', [ChatController::class, 'index']); //para obtener todos los chats de un usuario

    //contacts
    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('contacts/{contact}', [ContactController::class, 'show']);
    //Route::put('contacts/{contact}', [ContactController::class, 'update']);
    Route::delete('contacts/{contact}', [ContactController::class, 'delete']);

    //Rutas para Interest
    Route::get('interests', [InterestController::class, 'index']);
    Route::get('interests/{interest}', [InterestController::class, 'show']);
    Route::put('interests/{interest}', [InterestController::class, 'update']);
    Route::delete('interests/{interest}', [InterestController::class, 'delete']);
});


