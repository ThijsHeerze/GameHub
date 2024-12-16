<?php

namespace App\Http\Controllers\FTD;

use App\Http\Controllers\Controller;
use App\Models\FTD\Game;
use App\Models\FTD\Card;
use App\Models\FTD\Turn;
use App\Models\FTD\Player;
use Illuminate\Http\Request;

class TurnController extends Controller
{
    public function guess(Request $request, Player $player)
    {
        $game = $player->game;

        if (!$game) {
            return response()->json(['error' => 'Game not found for this player'], 404);
        }

        $guess = $request->input('guess');
        $card = $game->cards()->where('is_drawn', false)->inRandomOrder()->first();

        if (!$card) {
            return response()->json(['error' => 'No more cards to draw'], 400);
        }

        $correct = $guess === $card->value;
        $drinks = $correct ? 0 : abs((int)$guess - (int)$card->value);

        $turn = $game->turns()->create([
            'player_id' => $player->id,
            'guess' => $guess,
            'correct' => $correct,
            'drinks_taken' => $drinks,
        ]);

        $card->update(['is_drawn' => true]);

        // dd($request->all());


        return response()->json($turn);
    }
}
