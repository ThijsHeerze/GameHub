<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\TurnController;

Route::get('/', function () {
    return view('gamehub');
});

Route::post('/game/start', [GameController::class, 'startGame']);
Route::get('/game/{id}', [GameController::class, 'getGame']);
Route::post('/player/{player}/guess', [TurnController::class, 'guess']);
