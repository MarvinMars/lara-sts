<?php

namespace App\Classes\Stats\Sports\Abstracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class AbstractGame {
	/**
	 * @var Builder
	 */
	protected $query;

	/**
	 * @var \Illuminate\Support\Collection
	 */
	protected $results;

	protected $queryResults;

	/**
	 * AbstractFootballGame constructor.
	 *
	 * @param Builder $query
	 */
	public function __construct( Collection $queryResults ) {
		$this->queryResults = $queryResults;
		$this->results      = collect();
	}

	public abstract function getValues();

	public function _getQuery( ...$args ) {
		$result = 0;

		if ( is_array( $args ) && sizeof( $args ) === 2 ) {
			$group = $args[0];
			$key   = $args[1];

			$result = $this->queryResults->where( 'group', '=', $group )
			                             ->where( 'key', '=', $key )
			                             ->sum( 'value' );
		}

		return (float) $result;
	}

	public function _getMaxQuery( ...$args ) {
		$result = 0;

		if ( is_array( $args ) && sizeof( $args ) === 2 ) {
			$group = $args[0];
			$key   = $args[1];

			$result = $this->queryResults->where( 'group', '=', $group )
			                             ->where( 'key', '=', $key )
			                             ->max( 'value' );

		}

		return (float) $result;
	}
}
