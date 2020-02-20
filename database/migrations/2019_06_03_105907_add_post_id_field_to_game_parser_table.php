<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostIdFieldToGameParserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_parser', function (Blueprint $table) {
            $table->dropColumn('data');
            $table->integer('post_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_parser', function (Blueprint $table) {
            $table->dropColumn('post_id');
            $table->json('data');
        });
    }
}
