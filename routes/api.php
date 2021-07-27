<?php

use App\Http\Controllers\ContactController;
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

//contacts
Route::get('contacts', [ContactController::class, 'index']);
Route::get('contacts/{contact}', [ContactController::class, 'show']);
//Route::put('contacts/{contact}', [ContactController::class, 'update']);
Route::delete('contacts/{contact}', [ContactController::class, 'delete']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', [UserController::class, 'getAuthenticatedUser']);

    //contacts
    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('contacts/{contact}', [ContactController::class, 'show']);
  //Route::put('contacts/{contact}', [ContactController::class, 'update']);
    Route::delete('contacts/{contact}', [ContactController::class, 'delete']);
});

