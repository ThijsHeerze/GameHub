<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FTD\FtdGameController;
use App\Http\Controllers\FTD\TurnController;
use App\Http\Controllers\FTD\PlayerController;
use App\Http\Controllers\Whist\WhistController;

Route::get('/whist', [WhistController::class, 'index']); // Voor weergave van de frontend
Route::post('/whist/submit', [WhistController::class, 'submitScores']); // Voor opslaan van scores
Route::get('/whist/scores', [WhistController::class, 'getScores']); // Voor ophalen van opgeslagen scores

Route::post('/game/start', [FtdGameController::class, 'startGame']);
Route::get('/game/{id}', [FtdGameController::class, 'getGame']);
Route::post('/player/{player}/guess', [TurnController::class, 'guess']);

Route::get('/{any}', function () {
    return view('gamehub'); // Verwijs naar je Blade-template.
})->where('any', '.*');
