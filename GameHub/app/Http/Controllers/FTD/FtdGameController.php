<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FTD\Game;
use Illuminate\Http\Request;

class FtdGameController extends Controller
{
    public function startGame(Request $request)
    {
        $validated = $request->validate([
            'players' => 'required|array|min:2',
            'players.*' => 'required|string|max:255',
        ]);
        
        //:: allows you to declare a class without passing it as a string
        $game = Game::create();
        
        //-> to access methods and properties of an object
        foreach ($request->players as $name) {
            $game->players()->create(['name' => $name]);
        }

        $suits = ['hearts', 'diamonds', 'clubs', 'spades'];
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $game->cards()->create(['suit' => $suit, 'value' => $value]);
            }
        }

        return response()->json($game);
    }

    public function getGame($id)
    {
        $game = Game::with(['players', 'cards', 'turns'])->findOrFail($id);
        return response()->json($game);
    }
}
