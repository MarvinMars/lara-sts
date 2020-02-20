<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'events', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name' );
            $table->string( 'location' )->nullable();
            $table->string( 'venue' )->nullable();
            $table->integer( 'user_id' )->unsigned();
            $table->foreign( 'user_id' )
                ->on( 'users' )
                ->references( 'id' )
                ->onUpdate( 'CASCADE' )
                ->onDelete( 'CASCADE' );
            $table->integer('sport_id')->unsigned();
            $table->foreign('sport_id')
                ->references('id')
                ->on('sports')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string( 'file' );
            $table->string( 'file_timestamp' )->nullable();
            $table->date( 'event_date' )->nullable();
            $table->time( 'event_time' )->nullable();
            $table->integer( 'home_team_id' )->unsigned()->nullable();
            $table->foreign( 'home_team_id' )
                ->on( 'teams' )
                ->references( 'id' )
                ->onDelete( 'CASCADE' )
                ->onDelete( 'SET NULL' );
            $table->integer( 'away_team_id' )->unsigned()->nullable();
            $table->foreign( 'away_team_id' )
                ->on( 'teams' )
                ->references( 'id' )
                ->onDelete( 'CASCADE' )
                ->onDelete( 'SET NULL' );
            $table->boolean( 'is_completed' )->default( false );
            $table->boolean( 'is_archived' )->default( false );
            $table->string( 'status' )->nullable();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'events' );
    }
}
