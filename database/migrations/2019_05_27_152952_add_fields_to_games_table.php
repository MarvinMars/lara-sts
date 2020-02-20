<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->string('version')->nullable();
            $table->string('generated')->nullable();
            $table->string('visid')->nullable();
            $table->string('homeid')->nullable();
            $table->string('schedinn')->nullable();
            $table->json('umpires')->nullable();
            $table->json('officials')->nullable();
            $table->json('notes')->nullable();
            $table->json('rules')->nullable();
            $table->json('totals')->nullable();
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
                $table->dropColumn('version');
                $table->dropColumn('generated');
                $table->dropColumn('visid');
                $table->dropColumn('homeid');
                $table->dropColumn('schedinn');
                $table->dropColumn('umpires');
                $table->dropColumn('officials');
                $table->dropColumn('notes');
                $table->dropColumn('rules');
                $table->dropColumn('totals');
        });
    }
}
