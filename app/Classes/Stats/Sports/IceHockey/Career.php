<?php

namespace App\Classes\Stats\Sports\IceHockey;

use App\Classes\Stats\Sports\Career\IceHockey\OverallStats;
use App\Classes\Stats\Sports\SportClass;
use App\Models\Player;
use App\Models\PlayerValue;
use App\Models\Season;

/**
 * Class Career
 * @package App\Classes\Stats\Sports
 */
class Career extends SportClass {
	/**
	 * Career constructor.
	 *
	 * @param Player $player
	 * @param Season $season
	 */
	public function __construct( Player $player, Season $season = null ) {
		parent::__construct( $player, null, $season );
	}

	public function stats() {
		$model = new OverallStats( $this->_getQuery(), $this->player );

		return [
			$model->gp(),
			$model->g(),
			$model->a(),
			$model->pts(),
			$model->sh(),
			$model->shpct(),
			$model->plusMinus(),
			$model->penaltyMin(),
			$model->minors(),
			$model->majors(),
			$model->penaltyOthers(),
			$model->powerPlay(),
			$model->shorthand(),
			$model->fg(),
			$model->gw(),
			$model->gt(),
			$model->ot(),
			$model->ht(),
			$model->pn(),
			$model->ua(),
			$model->blk(),
		];
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Collection|static[]
	 */
	protected function _getQuery() {
		return PlayerValue::wherePlayerId( $this->player->id )
		                  ->whereHas( 'game', function ( $query ) {
			                  $query->whereHas( 'seasons', function ( $query ) {
				                  $query->where( 'id', '=', $this->season->id );
			                  } );
		                  } )->get();
	}


}
