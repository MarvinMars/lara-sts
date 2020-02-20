<?php

namespace App\Classes\Stats\Sports\FootballGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;

/**
 * Class Fumble
 * @package App\Classes\Stats\Sports\FootballGame
 */
class Fumbles extends AbstractGame
{

    public function getValues()
    {
        return [
            $this->ff(),
            $this->fr(),
            $this->yds(),
        ];
    }

    private function yds()
    {
        return $this->_getQuery('defense', 'fryds');
    }

    private function fr()
    {
        return $this->_getQuery('defense', 'fr');
    }

    private function ff()
    {
        return $this->_getQuery('defense', 'ff');
    }
}
