<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['suit', 'value', 'is_drawn'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
