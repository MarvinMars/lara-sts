<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReviewGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn(['oppcode', 'oppid', 'oppname', 'quarters', 'ownscore', 'oppscore', 'number']);
            $table->string('score')->nullable()->after('stadium');
            $table->string('opponent_code')->nullable()->after('stadium');
            $table->string('opponent_name')->nullable()->after('stadium');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn(['opponent_name', 'score']);
            $table->string('oppcode', 32)->nullable();
            $table->string('oppid', 32)->nullable();
            $table->string('oppname', 32)->nullable();
            $table->integer('quarters')->nullable();
            $table->integer('ownscore')->nullable();
            $table->integer('oppscore')->nullable();
            $table->integer('number')->nullable();
        });
    }
}
