<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerBlocksPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_hide_blocks', function (Blueprint $table) {
            $table->integer('player_id')->unsigned();
            $table->foreign('player_id')
                ->on('players')
                ->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('sport_block_id')->unsigned();
            $table->foreign('sport_block_id')
                ->on('sport_blocks')
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
        Schema::drop('player_hide_blocks');
    }
}
