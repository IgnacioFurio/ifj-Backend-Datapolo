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
        Schema::create('games', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('season_id');
            $table->foreign('season_id')
                ->references('id')
                ->on('seasons')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->unsignedBigInteger('my_team_id');
            $table->foreign('my_team_id')
                ->references('id')
                ->on('teams')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->unsignedBigInteger('my_rival_id');
            $table->foreign('my_rival_id')
                ->references('id')
                ->on('teams')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->boolean('locale');

            $table->boolean('friendly');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
