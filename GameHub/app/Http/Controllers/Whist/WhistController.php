<?php

namespace App\Http\Controllers\Whist;

use App\Http\Controllers\Whist\Controller;
use Illuminate\Http\Request;

class WhistController extends Controller
{

    // Opslaan van de scores en details
    public function submitScores(Request $request)
    {
        $data = $request->validate([
            'round' => 'required|integer|min:1',
            'players' => 'required|array',
            'players.*.name' => 'required|string|max:255',
            'players.*.bid' => 'required|integer|min:0',
            'players.*.tricks' => 'required|integer|min:0',
        ]);

        // Opslaan van de ronde
        $round = WhistRound::create([
            'round_number' => $data['round'],
        ]);

        // Opslaan van spelersgegevens
        foreach ($data['players'] as $playerData) {
            WhistPlayer::create([
                'round_id' => $round->id,
                'name' => $playerData['name'],
                'bid' => $playerData['bid'],
                'tricks' => $playerData['tricks'],
                'score' => $this->calculateScore($playerData['bid'], $playerData['tricks']),
            ]);
        }

        return response()->json(['message' => 'Scores opgeslagen'], 200);
    }

    // Ophalen van opgeslagen scores
    public function getScores()
    {
        $rounds = WhistRound::with('players')->get();

        return response()->json($rounds);
    }

    // Scoreberekening
    private function calculateScore($bid, $tricks)
    {
        if ($bid === $tricks) {
            return 10 + $tricks; // Correcte bieding
        }

        return -abs($bid - $tricks); // Foutieve bieding
    }

    public function getGame($id)
    {
        $game = Game::with(['players', 'cards', 'turns'])->findOrFail($id);
        return response()->json($game);
    }
}
