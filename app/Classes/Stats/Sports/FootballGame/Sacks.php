<?php

namespace App\Classes\Stats\Sports\FootballGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;

/**
 * Class Sacks
 * @package App\Classes\Stats\Sports\FootballGame
 */
class Sacks extends AbstractGame {

	public function getValues() {
		return [
			$this->total(),
			$this->yds(),
		];
	}


	private function total() {
		return $this->ua() + $this->a();
	}

	private function yds() {
		return $this->_getQuery( 'defense', 'sackyds' );
	}

	private function ua() {
		return $this->_getQuery( 'defense', 'sackua' );
	}

	private function a() {
		return $this->_getQuery( 'defense', 'sacka' ) * 0.5;
	}
}
