<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TurnController extends Controller
{
    public function guess(Request $request, Player $player)
    {
        if (!$player) {
            return response()->json(['error' => 'Player not found'], 404);
        }

        $game = $player->game;

        $guess = $request->input('guess');
        $card = $game->cards()->where('is_drawn', false)->inRandomOrder()->first();

        $correct = $guess === $card->value;
        $drinks = $correct ? 0 : abs((int)$guess - (int)$card->value);

        $turn = $game->turns()->create([
            'player_id' => $player->id,
            'guess' => $guess,
            'correct' => $correct,
            'drinks_taken' => $drinks,
        ]);

        $card->update(['is_drawn' => true]);

        return response()->json($turn);
    }
}
