<?php

namespace App\Classes\Stats\Sports\SoccerGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class GameByGame
 * @package App\Classes\Stats\Sports\FootballGame
 */
class GameByGame extends AbstractGame
{
    public function gp()
    {
        return $this->_getQuery('player', 'gp');
    }

    public function g()
    {
        return $this->_getQuery('shots', 'g');
    }

    public function a()
    {
        return $this->_getQuery('shots', 'a');
    }

    public function pts()
    {
        return $this->_getQuery('shots', 'ps');
    }

    public function sh()
    {
        return $this->_getQuery('shots', 'sh');
    }

    public function shPercent()
    {
        $g = $this->g();
        $sh = $this->sh();

        return (($g && (float)$sh > 0) ? ($g / $sh) : 0);
    }

    public function sog()
    {
        return $this->_getQuery('shots', 'sog');
    }

    public function sogPercent()
    {
        $g = $this->g();
        $sog = $this->sog();

        return (($g && (float)$sog > 0) ? ($g / $sog) : 0);
    }

    public function gw()
    {
        return $this->_getQuery('goaltype', 'gw');
    }

    public function min()
    {
        return $this->_getQuery('misc', 'minutes');
    }

    public function ga()
    {
        return $this->_getQuery('goalie', 'ga');
    }

    public function gaAvg()
    {
        $min = $this->min();
        $ga = $this->ga();

        return (($ga && (float)$min > 0) ? (($ga * 90) / $min) : 0);
    }

    public function sv()
    {
        return $this->_getQuery('goalie', 'saves');
    }

    public function sho()
    {
        return $this->_getQuery('goalie', 'shutout');
    }

    public function getValues()
    {
        return [];
    }
}
