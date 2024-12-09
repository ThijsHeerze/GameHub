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

        // try {
        //     $player->update(['drinks_taken' => $player->drinks_taken + $drinks]);
        // } catch (error) {
        //     console.error(error.response.data);
        // }

        return response()->json($turn);
    }
}
