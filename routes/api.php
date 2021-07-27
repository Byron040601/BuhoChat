<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::group(['middleware' => ['jwt.verify']], function() {
    //User
    Route::get('user', [UserController::class, 'getAuthenticatedUser']);
    Route::get('users', [UserController::class, 'index']);
    Route::get('', [UserController::class, 'show']);
    Route::get('user/{user}', [UserController::class, 'update']);

    //Chat
    Route::get('user/{user}/chats', [ChatController::class, 'index']); //para obtener todos los chats de un usuario
});

