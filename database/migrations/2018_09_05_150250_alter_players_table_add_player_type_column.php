<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPlayersTableAddPlayerTypeColumn extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table( 'players', function ( Blueprint $table ) {
			$table->integer( 'player_type_id' )->unsigned()->nullable();
			$table->foreign( 'player_type_id' )
			      ->references( 'id' )
			      ->on( 'player_types' )
			      ->onDelete( 'set null' )
			      ->onUpdate( 'cascade' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table( 'players', function ( Blueprint $table ) {
			$table->dropColumn( 'player_type_id' );
		} );
	}
}
