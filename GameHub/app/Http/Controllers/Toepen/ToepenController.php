<?php

namespace App\Http\Controllers\Toepen;

use Illuminate\Http\Request;
use App\Models\Toepen\Toepen; // Zorg ervoor dat het model correct is geïmporteerd
use App\Http\Controllers\Controller;

class ToepenController extends Controller
{
    public function addPlayer(Request $request)
    {
        // Valideer de invoer
        $validated = $request->validate([
            'player' => 'required|string|max:255',
        ]);

        // Haal de huidige game op of maak een nieuwe
        $game = Toepen::firstOrCreate(
            ['status' => 'ongoing'], // Zoek een lopend spel
            ['players' => [], 'scores' => []] // Initialiseer bij geen bestaande game
        );

        // Voeg de speler toe
        $players = $game->players;
        $scores = $game->scores;

        if (!in_array($validated['player'], $players)) {
            $players[] = $validated['player'];
            $scores[] = 0; // Nieuwe speler krijgt 0 punten
            $game->update(['players' => $players, 'scores' => $scores]);
        }

        return response()->json(['game' => $game]);
    }

    public function removePlayer(Request $request)
    {
        // Valideer de invoer
        $validated = $request->validate([
            'player' => 'required|string|max:255',
        ]);

        // Haal de huidige game op
        $game = Toepen::where('status', 'ongoing')->first();

        if (!$game) {
            return response()->json(['error' => 'Geen actief spel gevonden.'], 404);
        }

        // Verwijder de speler
        $players = $game->players;
        $scores = $game->scores;

        if (($key = array_search($validated['player'], $players)) !== false) {
            unset($players[$key]);
            unset($scores[$key]); // Verwijder ook de score van de speler
            $game->update(['players' => array_values($players), 'scores' => array_values($scores)]);
        }

        return response()->json(['game' => $game]);
    }

    // 4. Start het spel
    public function start(Request $request)
    {
        // Valideer de invoer
        $validated = $request->validate([
            'players' => 'required|array|min:2',
            'players.*' => 'required|string|max:255',
        ]);

        // Maak een nieuw spel aan
        $game = Toepen::create([
            'players' => $validated['players'],
            'scores' => array_fill(0, count($validated['players']), 0), // Initialiseer scores op 0
            'status' => 'ongoing',
        ]);

        return response()->json(['game' => $game]);
    }
    // 5. Toon de status van het spel
    public function status($id)
    {
        $game = Toepen::find($id);

        if (!$game) {
            return response()->json(['error' => 'Geen spel gevonden.'], 404);
        }

        return response()->json(['game' => $game]);
    }

    // 6. Haal het spel op
    public function getGame($id)
    {
        $game = Toepen::find($id);

        if (!$game) {
            return response()->json(['error' => 'Geen spel gevonden.'], 404);
        }

        return response()->json(['game' => $game]);
    }

    // 4. Beëindig het spel
    public function endGame($id)
    {
        $game = Toepen::find($id);

        if (!$game) {
            return response()->json(['error' => 'Spel niet gevonden.'], 404);
        }

        $game->status = 'finished';
        $game->save();

        return response()->json(['message' => 'Spel beëindigd.', 'game' => $game], 200);
    }
}
