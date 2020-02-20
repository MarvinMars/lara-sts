<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterGamesRemoveUniqueIndexGameid extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table( 'games', function ( Blueprint $table ) {
			$table->dropUnique( [ 'gameid' ] );
			$table->index( 'gameid' );
			$table->index( 'date' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table( 'games', function ( Blueprint $table ) {
			$table->dropIndex( [ 'gameid' ] );
			$table->dropIndex( [ 'date' ] );
			$table->unique( 'gameid' );
		} );
	}
}
