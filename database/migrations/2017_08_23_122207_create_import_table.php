<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file');
            $table->tinyInteger('status')->default(0);
            $table->integer('season_id')->unsigned();

            $table->foreign('season_id')
                ->references('id')->on('seasons')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('sport_id')->unsigned();
            $table->foreign('sport_id')
                ->references('id')->on('sports')
                ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::drop('imports');
    }
}
