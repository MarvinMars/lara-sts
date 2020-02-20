<?php

namespace App\Classes\Stats\Sports\Career\Football;

use App\Classes\Stats\Sports\Career\AbstractCareer;

class ScoringStats extends AbstractCareer {

	public function td() {
		return $this->_sumByGroupKey( 'scoring', 'td' );
	}

	public function rush() {
		return $this->_sumByGroupKey( 'rush', 'yds' );
	}

	public function rec() {
		return $this->_sumByGroupKey( 'rcv', 'yds' );
	}

	public function ret() {
		return $this->_sumByGroupKey( 'punt', 'no' );
	}

	public function fg() {
		return $this->_sumByGroupKey( 'scoring', 'fg' );
	}

	public function pat() {
		return $this->_sumByGroupKey( 'scoring', 'patkick' );
	}

	public function twoPt() {
		return $this->_sumByGroupKey( 'punt', 'plus50' );
	}

	public function tot() {
		return $this->rec() + $this->rush();
	}

	public function avgG() {
		$tot = $this->tot();
		$gp  = $this->gp();

		return ( $gp ? ( $tot / $gp ) : 0 );
	}


}
