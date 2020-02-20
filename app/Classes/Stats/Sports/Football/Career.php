<?php

namespace App\Classes\Stats\Sports\Football;

use App\Classes\Stats\Sports\Career\Football\AllPurposeStats;
use App\Classes\Stats\Sports\Career\Football\DefensiveStats;
use App\Classes\Stats\Sports\Career\Football\InterceptionsStats;
use App\Classes\Stats\Sports\Career\Football\PassingStats;
use App\Classes\Stats\Sports\Career\Football\ReceivingStats;
use App\Classes\Stats\Sports\Career\Football\RushingStats;
use App\Classes\Stats\Sports\Career\Football\SacksStats;
use App\Classes\Stats\Sports\Career\Football\ScoringStats;
use App\Classes\Stats\Sports\Career\Football\TotalOffenseStats;
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

	/**
	 * @return array
	 */
	public function sacks() {

		$model = new SacksStats( $this->_getQuery(), $this->player );

		return [
			number_format( $model->gp() ),
			$model->ua(),
			$model->a(),
			number_format( $model->tot(), 1 ),
			number_format( $model->yds() ),
		];
	}

	public function interceptions() {
		$model = new InterceptionsStats( $this->_getQuery(), $this->player );

		return [
			number_format( $model->gp() ),
			number_format( $model->no() ),
			number_format( $model->yds() ),
			number_format( $model->td() ),
			number_format( $model->long() ),
			number_format( $model->avgR(), 1 ),
			number_format( $model->avgG(), 1 ),
		];
	}

	/**
	 * @return array
	 */
	public function rushing() {
		$careerStats = new RushingStats( $this->_getQuery(), $this->player );

		return [
			number_format( $careerStats->gp() ),
			number_format( $careerStats->att() ),
			number_format( $careerStats->gain() ),
			number_format( $careerStats->loss() ),
			number_format( $careerStats->yds() ),
			number_format( $careerStats->avgA(), 1 ),
			number_format( $careerStats->td() ),
			number_format( $careerStats->long() ),
			number_format( $careerStats->avgG(), 1 ),
		];
	}

	/**
	 * @return array
	 */
	public function scoring() {
		$careerStats = new ScoringStats( $this->_getQuery(), $this->player );

		return [
			number_format( $careerStats->gp() ),
			number_format( $careerStats->td() ),
			number_format( $careerStats->rush() ),
			number_format( $careerStats->rec() ),
			number_format( $careerStats->ret() ),
			number_format( $careerStats->fg() ),
			number_format( $careerStats->pat() ),
			number_format( $careerStats->tot() ),
			number_format( $careerStats->avgG(), 1 ),
		];
	}

	/**
	 * @return array
	 */
	public function totalOffense() {
		$careerStats = new TotalOffenseStats( $this->_getQuery(), $this->player );

		return [
			number_format( $careerStats->gp() ),
			number_format( $careerStats->rush() ),
			number_format( $careerStats->pass() ),
			number_format( $careerStats->total() ),
			number_format( $careerStats->avgG(), 1 ),
		];
	}

	/**
	 * @return array
	 */
	public function passing() {
		$careerStats = new PassingStats( $this->_getQuery(), $this->player );

		return [
			number_format( $careerStats->gp() ),
			number_format( $careerStats->cmp() ),
			number_format( $careerStats->att() ),
			number_format( $careerStats->int() ),
			number_format( $careerStats->yds() ),
			number_format( $careerStats->td() ),
			number_format( $careerStats->long() ),
			number_format( $careerStats->percent(), 1 ),
			number_format( $careerStats->avgP(), 1 ),
			number_format( $careerStats->avgG(), 1 ),
			number_format( $careerStats->effic(), 2 ),
		];
	}

	/**
	 * @return array
	 */
	public function defensive() {
		$careerStats = new DefensiveStats( $this->_getQuery(), $this->player );

		return [
			number_format( $careerStats->gp() ),
			number_format( $careerStats->ua() ),
			number_format( $careerStats->a() ),
			number_format( $careerStats->tot() ),
			$careerStats->tfl(),
			number_format( $careerStats->tfly() ),
			number_format( $careerStats->int() ),
			number_format( $careerStats->ff() ),
			number_format( $careerStats->fr() ),
			number_format( $careerStats->blk() ),
		];
	}

	/**
	 * @return array
	 */
	public function receiving() {
		$careerStats = new ReceivingStats( $this->_getQuery(), $this->player );

		return [
			number_format( $careerStats->gp() ),
			number_format( $careerStats->no() ),
			number_format( $careerStats->yds() ),
			number_format( $careerStats->avg(), 1 ),
			number_format( $careerStats->td() ),
			number_format( $careerStats->long() ),
			number_format( $careerStats->avgG(), 1 ),
		];
	}

	/**
	 * @return array
	 */
	public function allPurpose() {
		$careerStats = new AllPurposeStats( $this->_getQuery(), $this->player );

		return [
			number_format( $careerStats->gp() ),
			number_format( $careerStats->rush() ),
			number_format( $careerStats->rcv() ),
			number_format( $careerStats->pr() ),
			number_format( $careerStats->kr() ),
			number_format( $careerStats->ir() ),
			number_format( $careerStats->tot() ),
			number_format( $careerStats->avgG(), 1 ),
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
