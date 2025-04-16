<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('toepens', function (Blueprint $table) {
            $table->id();
            $table->json('players')->nullable(); // Remove the default value
            $table->json('scores')->nullable(); // Remove the default value
            $table->string('status')->default('ongoing');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('toepens');
    }
};
