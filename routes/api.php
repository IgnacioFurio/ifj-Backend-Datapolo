<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\SeasonController;
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
Route::get('/teams', [TeamController::class, "getAllTeams"])->middleware('auth:sanctum', 'IsAdmin');

Route::group([
        'middleware' => ['auth:sanctum']
    ], function () {
        Route::post('/get-my-teams', [TeamController::class, "getAllMyTeams"]);
        Route::post('/my-teams', [TeamController::class, "createNewTeam"]);        
        Route::put('/my-teams', [TeamController::class, "modifyTeam"]);        
        Route::delete('/my-teams', [TeamController::class, "deleteTeam"]);        
    } 
);

//PLAYERS   
Route::get('/all-players', [PlayerController::class, "getAllPlayers"])->middleware('auth:sanctum', 'IsAdmin');

Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::post('/get-my-players', [PlayerController::class, "getAllMyPlayers"]);
    Route::post('/my-players', [PlayerController::class, "createNewPlayer"]);        
    Route::put('/my-players', [PlayerController::class, "modifyPlayer"]);        
    Route::delete('/my-players', [PlayerController::class, "deletePlayer"]);        
} 
);

//SEASONS
Route::group([
    'middleware' => ['auth:sanctum', 'IsAdmin']
], function() {
    Route::get('/seasons', [SeasonController::class, "getAllSeasons"]);
    Route::post('/seasons', [SeasonController::class, "createNewSeason"]);
    Route::put('/seasons', [SeasonController::class, "modifySeason"]);
    Route::delete('/seasons', [SeasonController::class, "deleteSeason"]);
});

//GAMES
Route::get('/all-games', [GamesController::class, "getAllGames"])->middleware('auth:sanctum', 'IsAdmin');

Route::group([
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/my-games', [GamesController::class, "getAllMyGames"]);
    Route::post('/my-games-by-team-id', [GamesController::class, "getAllMyGamesByTeamId"]);
    Route::post('/my-games', [GamesController::class, "createNewGame"]);        
    Route::put('/my-games', [GamesController::class, "modifyGame"]);        
    Route::delete('/my-games', [PlayerController::class, "deletePlayer"]);        
} 
);