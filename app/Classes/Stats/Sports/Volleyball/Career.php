<?php

namespace App\Classes\Stats\Sports\Volleyball;

use App\Classes\Stats\Sports\Career\Volleyball\VolleyballStats;
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
    public function offensive() {
        $careerStats = new VolleyballStats( $this->_getQuery(), $this->player );
        /*SP	MP	K	K/S	E	TA	%	A	A/S	SA	SA/S	SE*/
        return [
            number_format( $careerStats->sp() ),
            number_format( $careerStats->k() ),
            number_format( $careerStats->ks(), 2 ),
            number_format( $careerStats->e() ),
            number_format( $careerStats->atc_ta() ),
            number_format( $careerStats->pct(),2 ),
            number_format( $careerStats->a() ),
            number_format( $careerStats->as(),2 ),
            number_format( $careerStats->sa() ),
            number_format( $careerStats->sas(),2),
            number_format( $careerStats->se() ),
        ];
    }

	public function defensive() {
		$careerStats = new VolleyballStats( $this->_getQuery(), $this->player );
        /*DIG	D/S	RE	BS	BA	TB	B/S	BE	BHE	PTS	PTS/S*/
		return [
			number_format( $careerStats->dig() ),
			number_format( $careerStats->ds(), 2),
			number_format( $careerStats->re() ),
			number_format( $careerStats->bs(), 2),
            number_format( $careerStats->ba() ),
			number_format( $careerStats->tb() ),
			number_format( $careerStats->b_s(),2 ),
			number_format( $careerStats->be() ),
			number_format( $careerStats->bhe() ),
			number_format( $careerStats->pts() ),
            number_format( $careerStats->ptss(),2 ),
		];
	}

    public function totalOffensive() {
        $careerStats = new VolleyballStats( $this->_getQuery(), $this->player );
        /*SP	MP	K	K/S	E	TA	%	A	A/S	SA	SA/S	SE*/
        return [
            number_format( $careerStats->sp() ),
            number_format( $careerStats->k() ),
            number_format( $careerStats->ks(), 2 ),
            number_format( $careerStats->e() ),
            number_format( $careerStats->atc_ta() ),
            number_format( $careerStats->pct(),2 ),
            number_format( $careerStats->a() ),
            number_format( $careerStats->as(),2 ),
            number_format( $careerStats->sa() ),
            number_format( $careerStats->sas(),2),
            number_format( $careerStats->se() ),
        ];
    }

    public function totalDefensive() {
        $careerStats = new VolleyballStats( $this->_getQuery(), $this->player );
        /*SP	MP	K	K/S	E	TA	%	A	A/S	SA	SA/S	SE*/
        return [
            number_format( $careerStats->dig() ),
            number_format( $careerStats->ds(),2 ),
            number_format( $careerStats->re() ),
            number_format( $careerStats->bs(),2 ),
            number_format( $careerStats->ba() ),
            number_format( $careerStats->tb() ),
            number_format( $careerStats->b_s(),2 ),
            number_format( $careerStats->be() ),
            number_format( $careerStats->bhe() ),
            number_format( $careerStats->pts() ),
            number_format( $careerStats->ptss(), 2),
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
