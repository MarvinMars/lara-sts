<?php

namespace App\Classes\Stats\Sports;

use App\Classes\Stats\Sports\SoccerGame\GameByGame;
use App\Classes\Stats\Sports\SoccerGame\GameByGameGoalkeeping;

/**
 * Stats for the soccer game
 *
 * Class SoccerGame
 * @package App\Classes\Stats\Sports
 */
class SoccerGame extends SportClass
{
    public function gameByGameValues()
    {
        $class = new GameByGame($this->_getQuery());

        return [
            (int)$class->gp(),
            number_format($class->g()),
            number_format($class->a()),
            number_format($class->pts()),
            number_format($class->sh()),
            number_format($class->shPercent(), 3),
            number_format($class->sog()),
            number_format($class->sogPercent(), 3),
            number_format($class->gw()),
            number_format($class->min()),
        ];

    }

    public function gameByGameGoalkeepingValues()
    {
        $class = new GameByGame($this->_getQuery());

        return [
            number_format($class->min()),
            number_format($class->ga()),
            number_format($class->gaAvg(), 2),
            number_format($class->sv()),
            number_format($class->sho()),
            number_format($class->sh()),
        ];

    }

}
