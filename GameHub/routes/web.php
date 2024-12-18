<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FTD\FtdGameController;
use App\Http\Controllers\FTD\TurnController;
use App\Http\Controllers\FTD\PlayerController;
use App\Http\Controllers\PaardenRace\PaardenRaceController;

// FTD
Route::post('/game/start', [FtdGameController::class, 'startGame']);
Route::get('/game/{id}', [FtdGameController::class, 'getGame']);
Route::post('/player/{player}/guess', [TurnController::class, 'guess']);

// Paardenrace
Route::post('/paardenRace/start', [PaardenRaceController::class, 'start']);
Route::post('/paardenRace/draw/{id}', [PaardenRaceController::class, 'draw']);
Route::get('/paardenRace/status/{id}', [PaardenRaceController::class, 'status']);

// Catch-all route
Route::get('/{any}', function () {
    return view('gamehub'); 
})->where('any', '.*');
