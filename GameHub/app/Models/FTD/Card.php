<?php

namespace App\Models\FTD;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['suit', 'value', 'is_drawn'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
