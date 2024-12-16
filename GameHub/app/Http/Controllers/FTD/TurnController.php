<?php

namespace App\Http\Controllers\FTD;

use App\Http\Controllers\Controller;
use App\Models\FTD\Game;
use App\Models\FTD\Card;
use App\Models\FTD\Turn;
use App\Models\FTD\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TurnController extends Controller
{
    public function guess(Request $request, Player $player)
    {
        $request->validate([
            'guess' => 'required|string',
        ]);

        $game = $player->game;

        if (!$game) {
            Log::error('Game not found for player ID: ' . $player->id);
            return response()->json(['error' => 'Game not found for this player'], 404);
        }

        $guess = $request->input('guess');
        $card = $game->cards()->where('is_drawn', false)->inRandomOrder()->first();

        if (!$card) {
            Log::error('No more cards to draw for game ID: ' . $game->id);
            return response()->json(['error' => 'No more cards to draw'], 400);
        }

        $correct = $guess === $card->value;
        $drinks = $correct ? 0 : abs((int)$guess - (int)$card->value);

        try {
            $turn = new Turn();
            $turn->player_id = $player->id;
            $turn->game_id = $player->game_id;
            $turn->guess = $guess;
            $turn->correct = $correct;
            $turn->drinks_taken = $drinks;
            $turn->save();

            $card->update(['is_drawn' => true]);

            return response()->json($turn, 201);
        } catch (\Exception $e) {
            Log::error('Error saving turn for player ID: ' . $player->id . ' - ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
