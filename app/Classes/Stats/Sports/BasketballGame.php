<?php

namespace App\Classes\Stats\Sports;

use App\Classes\Stats\Sports\BasketballGame\GameByGame;

/**
 * Stats for the basketball game
 *
 * Class BasketballGame
 * @package App\Classes\Stats\Sports
 */
class BasketballGame extends SportClass
{

    /**
     * @return array
     */
    /* @deprecated  */
    public function gameByGameValues()
    {
        $class = new GameByGame($this->_getQuery());

        return [
            $class->pts(),
            $class->min(),
            $class->fgm() . ' - ' . $class->fga(),
            number_format($class->fgmApct(), 1) . '%',
            $class->threeFgM() . ' - ' . $class->threeFgA(),
            number_format($class->threeFgApct(), 1) . '%',
            $class->ftmM() . ' - ' . $class->ftmA(),
            number_format($class->ftmAPct(), 1) . '%',
            $class->off(),
            $class->def(),
            $class->total(),
            $class->pf(),
            $class->ast(),
            $class->to(),
            $class->blk(),
            $class->stl(),
        ];

    }
}
