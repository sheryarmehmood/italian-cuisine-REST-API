<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DishController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
 

Route::group([
    "middleware" => ["auth:api"]
], function(){

    // Route::get("profile", [AuthController::class, "profile"]);
    Route::get("refresh", [AuthController::class, "refreshToken"]);
    Route::get("logout", [AuthController::class, "logout"]);

});

//dishes routes
Route::group([
    "middleware" => ["auth:api"]
], function(){
    Route::get("get-dishes", [DishController::class, "index"]);
    Route::post("save-dish", [DishController::class, "store"]);
    Route::get('get-dish/{dishId}', [DishController::class, 'show']);
    Route::post('update-dish/{dishId}', [DishController::class, 'update']);
    Route::delete('delete-dish/{dishId}', [DishController::class, 'destroy']);
});
