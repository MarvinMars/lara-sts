<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameSportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_sport', function (Blueprint $table) {
            $table->integer('game_id')->unsigned();
            $table->integer('sport_id')->unsigned();
            $table->primary(['game_id', 'sport_id']);

            $table->foreign('game_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('sport_id')
                ->references('id')
                ->on('sports')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_sport');
    }
}
