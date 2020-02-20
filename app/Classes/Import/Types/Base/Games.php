<?php

namespace App\Classes\Import\Types\Base;

use App\Classes\Import\Classes\AbstractImport;
use App\Classes\Import\Interfaces\Import;
use App\Models\Game;
use Carbon\Carbon;

/**
 * Class Games
 * @package App\Classes\Import\Types\Base
 * @deprecated
 */
class Games extends AbstractImport implements Import {

	/**
	 * Read items from the specific files
	 */
	public function read() {
		if ( $this->xml->has( 'games' ) ) {
			$data = collect( $this->xml->get( 'games' ) );
			if ( isset( $data['game'] ) && count( $data['game'] ) ) {
				$this->data = collect( $data['game'] );
			}
		} elseif ( $this->xml->has( 'venue' ) ) {
			$data = $this->xml->get( 'venue' );
			if ( isset( $data['@gameid'] ) ) {
				$this->data = collect( [ $data ] );
			}
		}

		return $this;
	}

	/**
	 * Working with the items
	 */
	public function processing() {
		foreach ( $this->data->all() as $item ) {
			if ( ! is_array( $item ) ) {
				continue;
			}
			$item     = collect( $item );
			$model    = null;
			$gameDate = $item->get( '@date' );
			$gameId   = $item->get( '@gameid' );

			if ( false !== strtotime( $gameDate ) ) {
				$gameDate = Carbon::parse( $gameDate );
			} else {
				$gameDate = null;
			}

			if ( ! $gameId ) {
				$this->output->writeln( 'Game has not gameid' );
				continue;
			}

			/** @var Game $model */

			if ( $gameId && $gameDate instanceof Carbon ) {
				$model = Game::whereGameid( $gameId )->whereDate( 'date', $gameDate )->first();
			} elseif ( $gameId ) {
				$model = Game::whereGameid( $gameId )->first();
			}
			if ( ! $model ) {
				$this->output->writeln( 'Creating new game' );
				$model = new Game();
			}

			foreach ( $item as $attr => $value ) {
				$attr = $this->_parseAttribute( $attr );
				if ( $model->isFillable( $attr ) ) {
					try {
						$model->setAttribute( $attr, $value );
					} catch ( \Exception $e ) {
						$this->output->writeln( sprintf( 'Error: %s', $e->getMessage() ) );
					}
				}
			}

			$model->setAttribute( 'sport_id', $this->import->sport_id );
			$model = $model->fill( $this->row );

			if ( $model->save() ) {
				$model->seasons()->syncWithoutDetaching( $this->import->season_id );
			}
			$this->row[] = $model;
		}

		return $this;
	}
}
