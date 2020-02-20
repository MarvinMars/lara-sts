<?php

namespace App\Classes\Stats\Sports\Career\Football;

use App\Classes\Stats\Sports\Career\AbstractCareer;

class TotalOffenseStats extends AbstractCareer {

	public function rush() {
		return $this->_sumByGroupKey( 'rush', 'yds' );
	}

	public function pass() {
		return $this->_sumByGroupKey( 'pass', 'yds' );
	}

	public function total() {
		$rush = $this->rush();
		$pass = $this->pass();


		return $rush + $pass;
	}

	public function avgG() {
		$gp    = $this->gp();
		$total = $this->total();

		return ( $gp && $total ? ( $total / $gp ) : 0 );
	}
}
