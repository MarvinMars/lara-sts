<?php

namespace App\Classes\Stats\Sports\LacrosseGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class GameByGame
 * @package App\Classes\Stats\Sports\LacrosseGame
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

    public function fpg()
    {
        return $this->_getQuery('goaltype', 'freepos');
    }

    public function fps()
    {
        return $this->_getQuery('shots', 'freepos');
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

        return (($g && $sh) ? ($g / $sh) : 0);
    }

    public function sog()
    {
        return $this->_getQuery('shots', 'sog');
    }

    public function sogPercent()
    {
        $sh = $this->sh();
        $sog = $this->sog();

        return (($sh && $sog && (float)$sh > 0) ? ($sog / $sh) : 0);
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

        return (($ga && $min) ? (($ga * 90) / $min) : 0);
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
