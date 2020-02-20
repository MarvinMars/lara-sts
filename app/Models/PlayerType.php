<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Cache;
use Illuminate\Database\Eloquent\Model;
use Watson\Rememberable\Rememberable;

class PlayerType extends Model {
	use CrudTrait, Rememberable;

	/*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

	protected $table = 'player_types';
	// protected $primaryKey = 'id';
	// public $timestamps = false;
	// protected $guarded = ['id'];
	protected $fillable = [
		'name',
	];
	// protected $hidden = [];
	// protected $dates = [];

	/*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/

	public static function boot() {
		parent::boot();

		static::created( function ( PlayerType $model ) {
			Cache::forget( 'available_player_types' );
		} );

		static::updated( function ( PlayerType $model ) {
			Cache::forget( 'available_player_types' );
		} );
	}


	public static function getCachedItems() {
		$items = Cache::get( 'available_player_types', null );

		if ( ! $items ) {
			$items = PlayerType::all();

			Cache::put( 'available_player_types', $items, 10800 );
		}

		return $items;
	}

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

	public function sportBlocks() {
		return $this->belongsToMany(
			SportBlock::class,
			'player_type_sport_block',
			'player_type_id',
			'sport_block_id'
		);
	}

	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| ACCESORS
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/
}
