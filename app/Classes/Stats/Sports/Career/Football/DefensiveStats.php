<?php

namespace App\Classes\Stats\Sports\Career\Football;

use App\Classes\Stats\Sports\Career\AbstractCareer;

class DefensiveStats extends AbstractCareer {
	public function ua() {
		return $this->_sumByGroupKey( 'defense', 'tackua' );
	}

	public function a() {
		return $this->_sumByGroupKey( 'defense', 'tacka' );
	}

	public function tot() {
		return $this->a() + $this->ua();
	}

	public function tfl() {
		$tflua = $this->_sumByGroupKey( 'defense', 'tflua' );
		$tfla  = $this->_sumByGroupKey( 'defense', 'tfla' ) * 0.5;

		return $tfla + $tflua;
	}

	public function tfly() {
		return $this->_sumByGroupKey( 'defense', 'tflyds' );
	}

	public function ff() {
		return $this->_sumByGroupKey( 'defense', 'ff' );
	}

	public function fr() {
		return $this->_sumByGroupKey( 'defense', 'fr' );
	}

	public function blk() {
		return $this->_sumByGroupKey( 'defense', 'blkd' );
	}

	public function int() {
		return $this->_sumByGroupKey( 'defense', 'int' );
	}
}
