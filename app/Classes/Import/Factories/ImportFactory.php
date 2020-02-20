<?php

namespace App\Classes\Import\Factories;

use App\Classes\Import\Items\Games;
use App\Models\Import;
use App\Models\Sport;

/**
 * Class ImportFactory
 * @package App\Classes\Import
 *
 */
class ImportFactory {
	public static $types = [
		Sport::TYPE_BASEBALL   => 'Base',
		Sport::TYPE_FOOTBALL   => 'Base',
		Sport::TYPE_SOCCER     => 'Base',
		Sport::TYPE_BASKETBALL => 'Base',
		Sport::TYPE_ICE_HOCKEY => 'Base',
        Sport::TYPE_VOLLEYBALL => 'Base',
	];

	/**
	 * @param string $operation
	 * @param Import $importItem
	 *
	 * @return mixed
	 * @deprecated
	 */
	public static function create( string $operation, Import $importItem ) {
		$type = $importItem->sport->type;

		if ( ! isset( self::$types[ $type ] ) ) {
			abort( 500, "{$type} is not yet supported! Sorry!" );
		}

		$type = self::$types[ $type ];

		$class = "App\\Classes\\Import\\Types\\{$type}\\$operation";
		if ( ! class_exists( $class ) ) {
			abort( 500, "{$class} class is not exists" );
		}

		return new $class( $importItem );
	}

	public static function import( Import $import ) {
		return new Games( $import );
	}
}
