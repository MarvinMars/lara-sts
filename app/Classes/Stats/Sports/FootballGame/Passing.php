<?php

namespace App\Classes\Stats\Sports\FootballGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;

/**
 * Class Passing
 * @package App\Classes\Stats\Sports\FootballGame
 */
class Passing extends AbstractGame {
	public function cmp() {
		return $this->_getQuery( 'pass', 'comp' );
	}

	public function att() {
		return $this->_getQuery( 'pass', 'att' );
	}

	public function in() {
		return $this->_getQuery( 'pass', 'int' );
	}

	public function percent() {
		$cmp = $this->cmp();
		$att = $this->att();

		if ( (float)$att > 0 ) {
			return number_format( ( $cmp / $att ) * 100, 1 ) . '%';
		} else {
			return '0%';
		}
	}

	public function yds() {
		return $this->_getQuery( 'pass', 'yds' );
	}

	public function td() {
		return $this->_getQuery( 'pass', 'td' );
	}

	public function long() {
		return $this->_getMaxQuery( 'pass', 'long' );
	}

	public function getValues() {
		return [
			$this->cmp(),
			$this->att(),
			$this->yds(),
			$this->td(),
			$this->percent(),
			$this->in(),
			$this->long(),
		];
	}
}
