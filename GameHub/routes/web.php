<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FTD\FtdGameController;
use App\Http\Controllers\FTD\TurnController;
use App\Http\Controllers\FTD\PlayerController;
use App\Http\Controllers\Whist\WhistController;
use App\Http\Controllers\PaardenRace\PaardenRaceController;
use App\Http\Controllers\Toepen\ToepenController;

// Whist
Route::get('/whist', [WhistController::class, 'index']); // Voor weergave van de frontend
Route::post('/whist/submit', [WhistController::class, 'submitScores']); // Voor opslaan van scores
Route::get('/whist/scores', [WhistController::class, 'getScores']); // Voor ophalen van opgeslagen scores

// FTD
Route::post('/game/start', [FtdGameController::class, 'startGame']);
Route::get('/game/{id}', [FtdGameController::class, 'getGame']);
Route::post('/player/{player}/guess', [TurnController::class, 'guess']);

// Paardenrace
Route::post('/paardenRace/start', [PaardenRaceController::class, 'start']);
Route::post('/paardenRace/draw/{id}', [PaardenRaceController::class, 'draw']);
Route::get('/paardenRace/status/{id}', [PaardenRaceController::class, 'status']);

// Toepen
Route::post('/toepen/add-player', [ToepenController::class, 'addPlayer']);
Route::post('/toepen/remove-player', [ToepenController::class, 'removePlayer']);
Route::post('/toepen/start', [ToepenController::class, 'start']);
Route::get('/toepen/status/{id}', [ToepenController::class, 'status']);
Route::post('/toepen/add-point/{playerIndex}', [ToepenController::class, 'addPoint']);
Route::post('/toepen/end-game', [ToepenController::class, 'endGame']);


// Catch-all route
Route::get('/{any}', function () {
    return view('gamehub');
})->where('any', '.*');
