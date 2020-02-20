<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUniqueIndecesForPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropUnique(['checkname', 'team_id']);
            $table->unique(['checkname', 'team_id', 'sport_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropUnique(['checkname', 'team_id', 'sport_id']);
            $table->unique(['checkanme', 'team_id']);
        });
    }
}
