<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportSeasonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sport_season', function (Blueprint $table) {
            $table->integer('sport_id')->unsigned();
            $table->integer('season_id')->unsigned();
            $table->primary(['sport_id', 'season_id']);
            $table->foreign('sport_id')
                ->references('id')
                ->on('sports')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('season_id')
                ->references('id')
                ->on('seasons')
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
        Schema::drop('sport_season');
    }
}
