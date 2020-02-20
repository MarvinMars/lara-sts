<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSportBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sport_blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sport_type', 3)->index();
            $table->string('title');
            $table->string('block')->index();
            $table->unique(['sport_type', 'block']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sport_blocks');
    }
}
