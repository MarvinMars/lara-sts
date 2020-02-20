<?php

namespace App\Classes\Stats\Sports\FootballGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;

/**
 * Class Tackles
 * @package App\Classes\Stats\Sports\FootballGame
 */
class Tackles extends AbstractGame {

	public function getValues() {
		return [
			$this->solo(),
			$this->ast(),
			$this->total(),
			$this->tfl(),
			$this->yds(),
		];
	}

	private function solo() {
		return $this->_getQuery( 'defense', 'tackua' );
	}

	private function ast() {
		return $this->_getQuery( 'defense', 'tacka' );
	}

	private function total() {
		return $this->solo() + $this->ast();
	}

	private function tfl() {
		$tflua = $this->_getQuery( 'defense', 'tflua' );
		$tfla  = $this->_getQuery( 'defense', 'tfla' ) * 0.5;

		return $tfla + $tflua;
	}

	private function yds() {
		return $this->_getQuery( 'defense', 'tflyds' );
	}
}
