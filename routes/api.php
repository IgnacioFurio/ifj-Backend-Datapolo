<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//AUTH
Route::post('/newuser',[AuthController::class, "newUser"]);
Route::post('/login',[AuthController::class, "login"]);
Route::post('/logout',[AuthController::class, "logout"])->middleware('auth:sanctum');

//USER
Route::post('/user', [UserController::class, "getUserData"]);

//TEAMS
Route::get('/teams', [TeamController::class, "getAllTeams"]);
Route::get('/my-teams', [TeamController::class, "getAllMyTeams"]);
