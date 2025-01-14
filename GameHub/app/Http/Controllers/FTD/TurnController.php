<?php

namespace App\Http\Controllers\FTD;

use App\Http\Controllers\Controller;
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

        // Trek een willekeurige kaart die nog niet is getrokken
        $card = $game->cards()->where('is_drawn', false)->first();
        if (!$card) {
            return response()->json(['error' => 'Geen kaarten meer beschikbaar'], 400);
        }

        // Controleer of er al een eerdere gok is gedaan in de huidige beurt
        $previousTurn = $game->turns()->where('player_id', $player->id)->latest()->first();

        if (!$previousTurn || $previousTurn->correct) {
            // Eerste gok of vorige beurt was correct
            $correct = $guess === $card->value;

            if ($correct) {
                // Correct bij de eerste poging
                $turn = $game->turns()->create([
                    'player_id' => $player->id,
                    'guess' => $guess,
                    'correct' => true,
                    'drinks_taken' => 0,
                ]);
                $card->update(['is_drawn' => true]);

                return response()->json([
                    'message' => 'Correct!',
                    'turn' => $turn,
                ]);
            } else {
                // Fout, geef feedback (hoger/lager)
                return response()->json([
                    'message' => $guess < $card->value ? 'Hoger' : 'Lager',
                    'second_chance' => true,
                ]);
            }
        } else {
            // Tweede gok
            $correct = $guess === $card->value;

            if ($correct) {
                // Correct bij de tweede poging
                $turn = $game->turns()->create([
                    'player_id' => $player->id,
                    'guess' => $guess,
                    'correct' => true,
                    'drinks_taken' => 0,
                ]);
                $card->update(['is_drawn' => true]);

                return response()->json([
                    'message' => 'Correct!',
                    'turn' => $turn,
                ]);
            } else {
                // Fout bij de tweede poging, bereken aantal slokken
                $cardValues = ['2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10, 'J' => 11, 'Q' => 12, 'K' => 13, 'A' => 14];
                $guessValue = $cardValues[$guess] ?? 0;
                $cardValue = $cardValues[$card->value] ?? 0;

                $drinks = abs($guessValue - $cardValue);

                $turn = $game->turns()->create([
                    'player_id' => $player->id,
                    'guess' => $guess,
                    'correct' => false,
                    'drinks_taken' => $drinks,
                ]);

                $card->update(['is_drawn' => true]);

                return response()->json([
                    'message' => "Fout! Je moet $drinks slokken nemen.",
                    'turn' => $turn,
                ]);
            }
        }
    }
}
