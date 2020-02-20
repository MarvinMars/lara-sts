<?php

namespace App\Classes\Stats\Sports;

use App\Classes\Stats\Sports\VolleyballGame\GameByGame;

/**
 * Stats for the volleyball game
 *
 * Class VolleyballGame
 * @package App\Classes\Stats\Sports
 */
class VolleyballGame extends SportClass
{

    /**
     * @return array
     */
    public function gameByGameValues()
    {
        $class = new GameByGame($this->_getQuery());

        return [
            $class->k(),
            $class->attack_e(),
            $class->ta(),
            number_format($class->pct(),2),
            $class->ast(),
            $class->set_e(),
            $class->sa(),
            $class->se(),
            $class->re(),
            $class->dig(),
            $class->bs(),
            $class->ba(),
            $class->be(),
            $class->tb(),
            number_format($class->bhe(),2),
            number_format($class->pts(),2),
        ];

    }
}
