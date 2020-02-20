<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlayerValuesValueChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('player_values', function (Blueprint $table) {
            $table->dropColumn('value');
        });

        Schema::table('player_values', function (Blueprint $table) {
            $table->decimal('value', 15, 3)->default(0);
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
            $table->string('value', 255)->nullable()->change();
        });
    }
}
