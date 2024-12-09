<?php

namespace App\Models\FTD;

use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    protected $fillable = ['guess', 'correct', 'drinks_taken'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}