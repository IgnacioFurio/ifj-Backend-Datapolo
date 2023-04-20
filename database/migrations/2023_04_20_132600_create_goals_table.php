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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('team_id');
            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')
                ->references('id')
                ->on('games')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('player_id');
            $table->foreign('player_id')
                ->references('id')
                ->on('games')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
