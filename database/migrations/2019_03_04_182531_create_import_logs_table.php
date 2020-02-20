<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('import_id')->unsigned();
            $table->foreign('import_id')
                ->on('imports')
                ->references('id')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('type', 16)->index();
            $table->text('content');
            $table->timestamps(4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_logs');
    }
}
