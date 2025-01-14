<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhistRoundsTable extends Migration
{
    public function up()
    {
        Schema::create('whist_rounds', function (Blueprint $table) {
            $table->id();
            $table->integer('round_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('whist_rounds');
    }
}
