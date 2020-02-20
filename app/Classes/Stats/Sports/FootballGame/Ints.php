<?php

namespace App\Classes\Stats\Sports\FootballGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;

/**
 * Class Ints
 * @package App\Classes\Stats\Sports\FootballGame
 */
class Ints extends AbstractGame
{

    public function getValues()
    {
        return [
            $this->total(),
            $this->yds(),
        ];
    }


    private function total()
    {
        return $this->_getQuery('defense', 'int');
    }

    private function yds()
    {
        return $this->_getQuery('defense', 'intyds');
    }
}
