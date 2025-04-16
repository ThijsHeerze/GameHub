<?php

namespace App\Http\Controllers\Toepen;

use Illuminate\Http\Request;
use App\Models\Toepen\Toepen; // Zorg ervoor dat het model correct is geïmporteerd
use App\Http\Controllers\Controller;

class ToepenController extends Controller
{
    // 1. Toon het formulier voor spelers toevoegen
    public function showForm()
    {
        $game = Toepen::latest()->first(); // Haal de laatste game op, indien bestaand
        return view('toepen.form', compact('game'));
    }

    public function getCurrentGame()
    {
        $game = Toepen::where('status', 'ongoing')->first();

        if (!$game) {
            return response()->json(['game' => null]);
        }

        return response()->json(['game' => $game]);
    }

    // 2. Voeg spelers toe aan de game
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

    // 3. Geef een punt aan een speler
    public function addPoint($playerIndex)
    {
        $game = Toepen::where('status', 'ongoing')->first();

        if (!$game) {
            return response()->json(['error' => 'Geen actief spel gevonden.'], 404);
        }

        $scores = $game->scores;
        $scores[$playerIndex] += 1; // Verhoog de score van de speler
        $game->update(['scores' => $scores]);

        return response()->json(['message' => 'Punt toegevoegd aan speler!', 'game' => $game]);
    }

    // 4. Beëindig het spel
    public function endGame()
    {
        $game = Toepen::where('status', 'ongoing')->first();

        if ($game) {
            $game->update(['status' => 'finished']);
        }

        return response()->json(['message' => 'Het spel is beëindigd.']);
    }
}
