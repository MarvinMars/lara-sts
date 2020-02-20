<?php

namespace App\Classes\Stats\Sports\FootballGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Rushing
 * @package App\Classes\Stats\Sports\FootballGame
 */
class Rushing extends AbstractGame
{
    public function att()
    {
        return $this->_getQuery('rush', 'att');
    }

    public function yds()
    {
        return $this->_getQuery('rush', 'yds');
    }

    public function td()
    {
        return $this->_getQuery('rush', 'td');
    }

    public function long()
    {
        return $this->_getMaxQuery('rush', 'long');
    }

    public function getValues()
    {
        return [
            $this->att(),
            $this->yds(),
            $this->td(),
            $this->long(),
        ];
    }
}
