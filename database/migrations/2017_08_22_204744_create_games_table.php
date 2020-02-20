<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gameid', 32)->unique();
            $table->string('title', 32)->index();
            $table->date('date');
            $table->time('start');
            $table->string('oppcode', 32)->nullable();
            $table->string('oppid', 32)->nullable();
            $table->string('oppname', 32)->nullable();
            $table->string('site', 32)->nullable();
            $table->string('stadium', 32)->nullable();
            $table->integer('quarters')->nullable();
            $table->integer('ownscore')->nullable();
            $table->integer('oppscore')->nullable();
            $table->integer('attend')->nullable();
            $table->time('duration')->nullable();
            $table->boolean('leaguegame')->default(false);
            $table->boolean('neutralgame')->default(false);
            $table->boolean('nitegame')->default(false);
            $table->boolean('postseason')->default(false);
            $table->boolean('homeaway')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('games');
    }
}
