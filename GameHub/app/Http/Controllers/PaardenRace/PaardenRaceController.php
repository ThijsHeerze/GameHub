<?php

namespace App\Http\Controllers\PaardenRace;

use App\Models\PaardenRace\Race;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaardenRaceController extends Controller
{
    private $suits = ['Harten ♥', 'Schoppen ♠', 'Ruiten ♦', 'Klaveren ♣'];

    public function start()
    {
        // Een nieuw spel starten
        $deck = collect(range(1, 52))->shuffle(); // Geschud deck
        $progress = array_fill_keys($this->suits, 0);

        $race = Race::create([
            'progress' => $progress,
            'deck' => $deck,
        ]);

        return response()->json(['message' => 'Het spel is gestart!', 'race_id' => $race->id]);
    }

    public function draw($id)
    {
        $race = Race::findOrFail($id);

        if ($race->winner) {
            return response()->json(['winner' => $race->winner]);
        }

        $deck = collect($race->deck);
        $progress = $race->progress;

        if ($deck->isEmpty()) {
            return response()->json(['error' => 'Geen kaarten meer over.']);
        }

        $card = $deck->shift(); // Trek een kaart
        $suitIndex = ($card - 1) % 4; // Bepaal de index van de kleur
        $suit = $this->suits[$suitIndex]; // Haal de kleur op basis van de index

        // Zorg ervoor dat de volgorde van de kleuren consistent blijft
        $orderedProgress = [];
        foreach ($this->suits as $s) {
            $orderedProgress[$s] = $progress[$s];
        }

        $orderedProgress[$suit] += 1; // Beweeg het paard
        $race->update([
            'deck' => $deck,
            'progress' => $orderedProgress,
        ]);

        // Controleer op winnaar
        if ($orderedProgress[$suit] >= 6) { // Winconditie
            $race->update(['winner' => $suit]);
            return response()->json(['winner' => $suit, 'progress' => $orderedProgress]);
        }

        return response()->json(['card' => $card, 'suit' => $suit, 'progress' => $orderedProgress]);
    }

    public function status($id)
    {
        $race = Race::findOrFail($id);

        return response()->json([
            'progress' => $race->progress,
            'winner' => $race->winner,
        ]);
    }
}
