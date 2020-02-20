<?php

namespace App\Classes\Stats\Sports\Career\Football;

use App\Classes\Stats\Sports\Career\AbstractCareer;

class SacksStats extends AbstractCareer {
	public function ua() {
		return $this->_sumByGroupKey( 'defense', 'sackua' );
	}

	public function a() {
		return $this->_sumByGroupKey( 'defense', 'sacka' ) * 0.5;
	}

	public function tot() {
		return $this->a() + $this->ua();
	}

	public function yds() {
		return $this->_sumByGroupKey( 'defense', 'sackyds' );
	}
}
