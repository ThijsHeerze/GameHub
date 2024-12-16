<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('turns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained()->onDelete('cascade');
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            $table->string('guess');
            $table->boolean('correct');
            $table->integer('drinks_taken');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('turns');
    }
};