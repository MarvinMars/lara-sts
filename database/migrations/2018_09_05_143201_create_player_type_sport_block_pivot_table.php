<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlayerTypeSportBlockPivotTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'player_type_sport_block', function ( Blueprint $table ) {
			$table->integer( 'player_type_id' )->unsigned()->index();
			$table->foreign( 'player_type_id' )->references( 'id' )->on( 'player_types' )->onDelete( 'cascade' );
			$table->integer( 'sport_block_id' )->unsigned()->index();
			$table->foreign( 'sport_block_id' )->references( 'id' )->on( 'sport_blocks' )->onDelete( 'cascade' );
			$table->primary( [ 'player_type_id', 'sport_block_id' ] );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'player_type_sport_block' );
	}
}
