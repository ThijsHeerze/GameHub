<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FTD\FtdGameController;
use App\Http\Controllers\FTD\TurnController;

Route::get('/', function () {
    return view('gamehub');
});

Route::post('/game/start', [FtdGameController::class, 'startGame']);
Route::get('/game/{id}', [FtdGameController::class, 'getGame']);
Route::post('/player/{player}/guess', [TurnController::class, 'guess']);
