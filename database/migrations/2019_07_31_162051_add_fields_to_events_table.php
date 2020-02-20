<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
           $table->json('parse_result')->nullable();
           $table->string('file')->unique()->change();
           $table->integer( 'status' )->default( 2 )->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('parse_result');
            $table->dropForeign(['file'])->change();
            $table->string( 'status' )->nullable()->change();
        });
    }
}
