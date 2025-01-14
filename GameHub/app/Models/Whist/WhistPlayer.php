<?php

namespace App\Models\Whist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhistPlayer extends Model
{
    use HasFactory;

    protected $fillable = ['round_id', 'name', 'bid', 'tricks', 'score'];

    public function round()
    {
        return $this->belongsTo(WhistRound::class);
    }
}
