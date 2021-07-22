<?php

use App\Http\Controllers\InterestController;
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

//Rutas para Interest
Route::get('interests',[InterestController::class, 'index']);
Route::get('interests/{interest}',[InterestController::class, 'show']);
Route::put('interests/{interest}',[InterestController::class, 'update']);
Route::delete('interests/{interest}',[InterestController::class, 'delete']);



Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user', [UserController::class, 'getAuthenticatedUser']);
});

