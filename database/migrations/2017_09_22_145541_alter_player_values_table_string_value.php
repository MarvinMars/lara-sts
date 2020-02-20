<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlayerValuesTableStringValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('player_values', function (Blueprint $table) {
            $table->string('raw_value')->nullable()->index();
        });

        foreach(\App\Models\PlayerValue::all() as $model){
            $model->raw_value = $model->value;
            $model->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('player_values', function (Blueprint $table) {
            $table->dropColumn('raw_value');
        });
    }
}
