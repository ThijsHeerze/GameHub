<?php

namespace App\Http\Controllers\PaardenRace;

use App\Models\PaardenRace\Race;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaardenRaceController extends Controller
{
    private $suits = ['Harten', 'Schoppen', 'Klaveren', 'Ruiten'];

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
        $suit = $this->suits[($card - 1) % 4]; // Bepaal de kleur

        $progress[$suit] += 1; // Beweeg het paard
        $race->update([
            'deck' => $deck,
            'progress' => $progress,
        ]);

        // Controleer op winnaar
        if ($progress[$suit] >= 6) { // Winconditie
            $race->update(['winner' => $suit]);
            return response()->json(['winner' => $suit, 'progress' => $progress]);
        }

        return response()->json(['card' => $card, 'suit' => $suit, 'progress' => $progress]);
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
