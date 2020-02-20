<?php

namespace App\Classes\Import\Types\Base;

use App\Classes\Import\Classes\AbstractImport;
use App\Classes\Import\Interfaces\Import;
use App\Models\Game;
use App\Models\Player;
use App\Models\PlayerValue;
use App\Models\Team;
use Carbon\Carbon;

/**
 * Class Players
 * @package App\Classes\Import\Types\Base
 * @deprecated
 */
class Players extends AbstractImport implements Import {
	protected $gameId;

	/**
	 * Read items from the specific files
	 */
	public function read() {
		$this->data = collect();
		if ( $data = $this->xml->get( 'team' ) ) {
			if ( ! is_array( $data ) ) {
				$this->output->writeln( 'Wrong data in team' );

				return $this;
			}
			//looking for players
			foreach ( $data as $team => $item ) {
				if ( ! is_array( $item ) ) {
					continue;
				}

				if ( ( $team = $this->getTeam( $item ) ) ) {
				    $team_id_status = false;
				    if( ! empty ( $this->allowed_team_id ) ) {
                        foreach ( $this->allowed_team_id as $id ) {
                            if ( ( strcasecmp( $team->shortcode, $id ) === 0 ) ) {
                                $team_id_status = true;
                            }
                        }
                    }
					if ( $team_id_status ) {
						$this->setPlayers( $item, $team );
					} else {
						$this->output->writeln( sprintf( 'Skip %s\'s players', $team->shortcode ) );
					}

				}
			}
			//Looking for gameid for the team
			if ( $this->xml->has( 'venue' ) ) {
				$venue = collect( (array) $this->xml->get( 'venue', [] ) );

				$gameDate = $venue->get( '@date' );
				$gameId   = $venue->get( '@gameid' );

				if ( false !== strtotime( $gameDate ) ) {
					$gameDate = Carbon::parse( $gameDate );
				} else {
					$gameDate = null;
				}

				if ( $gameId && $gameDate instanceof Carbon ) {
					$model = Game::whereGameid( $gameId )->whereDate( 'date', $gameDate )->first();
				} elseif ( $gameId ) {
					$model = Game::whereGameid( $gameId )->first();
				}

				if ( $model ) {
					$this->gameId = $model->id;
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

			$name = $item->get( 'checkname' );

			if ( ! $name ) {
				$name = $item->get( 'name' );
			}

			$teamId = $item->get( 'team_id' );

			if ( $name && $teamId ) {
				$model = Player::whereTeamId( $teamId )
				               ->whereCheckname( $name )
				               ->first();
			} else {
				$this->output->writeln( 'Skipping player without name or team id' );
				continue;
			}


			if ( ! $model ) {
				$model = new Player();
			}

			foreach ( $item as $attr => $value ) {
				$attr = $this->_parseAttribute( $attr );
				if ( $model->isFillable( $attr ) ) {
					$model->setAttribute( $attr, $value );
				}
			}

			$model->checkname = $name;
			$model->sport_id  = $this->import->sport_id;

			try {
				if ( $model->save() ) {
					$this->output->writeln( sprintf( '    Player %s from team %s saved', $model->name,
						$model->team->title ) );

					$gamePlayed = ! ! intval( $item->get( 'gp', 0 ) );

					if ( $this->gameId && $gamePlayed ) {
						$model->games()->syncWithoutDetaching( $this->gameId );
					}

					$this->_saveValues( $model, $item->toArray() );

					$model->seasons()->syncWithoutDetaching( $this->import->season_id );
				} else {
					echo 'Player does not saved' . PHP_EOL;
				}

				$this->row[] = $model;
			} catch ( \Exception $e ) {
				echo str_limit( $e->getMessage() ) . PHP_EOL;
			}
		}

		return $this;
	}

	/**
	 * @param Player $model
	 * @param array $item
	 */
	private function _saveValues( Player $model, array $item ) {
		$this->output->writeln( sprintf( '    Saving player values for %d', $model->id ) );
		//delete old values for the selected game
		PlayerValue::wherePlayerId( $model->id )->whereGameId( $this->gameId )->delete();

		$itemsToSave = [];

		if ( $values = $this->_parseValues( $item ) ) {
			foreach ( $values as $value ) {
				$numValue = 0;

				if ( is_numeric( $value['value'] ) ) {
					$numValue = $value['value'];
				}

				$itemsToSave[] = [
					'game_id'   => $this->gameId,
					'player_id' => $model->id,
					'group'     => $value['group'],
					'key'       => $value['key'],
					'value'     => $numValue,
					'raw_value' => $value['value'],
					'context'   => $value['context'],
				];
			}
		}
		$start = microtime( true );
		if ( $itemsToSave ) {
			PlayerValue::insert( $itemsToSave );
		}
		$end = microtime( true ) - $start;
		$this->output->writeln( sprintf( '        Saved player values for %d. Took %s', $model->id,
			round( $end, 3 ) ) );
	}


	private function _parseValues( array $item, string $currentGroup = 'player', $context = null ) {
		$result = [];
		foreach ( $item as $group => $value ) {
			if ( ! is_array( $value ) ) {
				$result[] = [
					'group'   => $currentGroup,
					'key'     => $this->_parseAttribute( $group ),
					'context' => $context,
					'value'   => $value,
				];
			} else {
				$currentContext = null;
				if ( isset( $value['@context'] ) ) {
					$currentContext = $value['@context'];
					unset( $value['@context'] );
				}
				$result = array_merge( $result,
					$this->_parseValues( $value, ( ! is_numeric( $group ) ? $group : $currentGroup ),
						$currentContext ) );
			}
		}

		return $result;
	}

	/**
	 * Get current team based on XML
	 *
	 * @param array $item
	 *
	 * @return Team|null
	 */
	private function getTeam( array $item ): ?Team {
		$item = collect( $item );

		$model = null;

		if ( $teamId = $item->get( '@id' ) ) {
			$model = Team::whereShortcode( $teamId )->first();
		}

		if ( ! $model && ( $code = $item->get( '@code' ) ) ) {
			$model = Team::whereCode( $code )->first();
		}

		return ( $model ?: null );
	}


	private function setPlayers( array $item, Team $team ): void {
		$item = collect( $item );

		if ( $playersArray = $item->get( 'player', [] ) ) {
			$players = collect( $playersArray )->map( function ( $item ) use ( $team ) {
				if ( ! is_array( $item ) ) {
					return $item;
				}

				$result = [];
				foreach ( $item as $key => $value ) {
					$result[ $this->_parseAttribute( $key ) ] = $value;
				}

				$result['team_id'] = $team->id;

				return $result;
			} );

			$this->data = $this->data->merge( $players );
		}
	}
}
