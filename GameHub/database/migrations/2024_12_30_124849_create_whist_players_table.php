<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhistPlayersTable extends Migration
{
    public function up()
    {
        Schema::create('whist_players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('round_id')->constrained('whist_rounds')->onDelete('cascade');
            $table->string('name');
            $table->integer('bid');
            $table->integer('tricks');
            $table->integer('score');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('whist_players');
    }
}
