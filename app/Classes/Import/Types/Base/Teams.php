<?php

namespace App\Classes\Import\Types\Base;

use App\Classes\Import\Classes\AbstractImport;
use App\Classes\Import\Interfaces\Import;
use App\Models\Game;
use App\Models\Team;

/**
 * Class Teams
 * @package App\Classes\Import\Types\Base
 * @deprecated
 */
class Teams extends AbstractImport implements Import {

	protected $gameId;

	/**
	 * Read items from the specific files
	 */
	public function read() {
		//Looking for team data
		if ( $read = $this->xml->has( 'team' ) ) {
			$data = $this->xml->get( 'team' );
			if ( count( $data ) && is_array( $data ) ) {
				$this->data = collect( $data )->map( function ( $item ) {
					if ( ! is_array( $item ) ) {
						return $item;
					}
					$result = [];
					foreach ( $item as $key => $value ) {
						$result[ $this->_parseAttribute( $key ) ] = $value;
					}

					return $result;
				} );
				//Looking for gameid for the team
				if ( $this->xml->has( 'venue' ) ) {
					$venue = $this->xml->get( 'venue' );
					if ( isset( $venue['@gameid'] ) ) {
						if ( $game = Game::whereGameid( $venue['@gameid'] )->first() ) {
							$this->gameId = $game->id;
						}
					}
				}
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
			$item  = collect( $item );
			$model = null;
            $teamId = $item->get( 'id' ) ? $item->get( 'id' ) : false ;
			if ( $teamId ) {
                $model = Team::whereShortcode( $teamId )->first();
			} else {
				$this->output->writeln( 'Team without code.' );
				continue;
			}

			if ( $model instanceof Team ) {
				$this->output->writeln( sprintf( 'Team %s already exists', $model->title ) );
			}

			if ( ! $model ) {
				$this->output->writeln( 'New team' );
				$model = new Team();
			}

			foreach ( $item as $attr => $value ) {
				$attr = $this->_parseAttribute( $attr );
				if ( $model->isFillable( $attr ) && ! empty( $value ) ) {
					$model->setAttribute( $attr, $value );
				}
			}

			if ( $teamId ) {
				$model->setAttribute( 'shortcode', $teamId );
			}

			if ( $model->save() ) {
				if ( $this->gameId ) {
					$model->games()->syncWithoutDetaching( $this->gameId );
				}
			}
			$this->row[] = $model;
		}

		return $this;
	}


}
