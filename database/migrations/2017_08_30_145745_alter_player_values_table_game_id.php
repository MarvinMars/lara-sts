<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlayerValuesTableGameId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('player_values', function (Blueprint $table) {
            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')
                ->on('games')
                ->references('id')
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
        Schema::table('player_values', function (Blueprint $table) {
            $table->dropColumn('game_id');
        });
    }
}
