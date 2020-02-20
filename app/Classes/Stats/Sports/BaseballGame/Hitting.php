<?php

namespace App\Classes\Stats\Sports\BaseballGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;
use Illuminate\Database\Eloquent\Builder;

class Hitting extends AbstractGame
{
    public function gs()
    {
        return $this->_getQuery('player', 'gs');
    }

    public function ab()
    {
        return $this->_getQuery('hitting', 'ab');
    }

    public function r()
    {
        return $this->_getQuery('hitting', 'r');
    }

    public function h()
    {
        return $this->_getQuery('hitting', 'h');
    }

    public function rbi()
    {
        return $this->_getQuery('hitting', 'rbi');
    }

    public function twoB()
    {
        return $this->_getQuery('hitting', 'double');
    }

    public function threeB()
    {
        return $this->_getQuery('hitting', 'triple');
    }

    public function hr()
    {
        return $this->_getQuery('hitting', 'hr');
    }

    public function bb()
    {
        return $this->_getQuery('hitting', 'bb');
    }

    public function ibb()
    {
        return $this->_getQuery('hitting', 'ibb');
    }

    public function sb()
    {
        return $this->_getQuery('hitting', 'sb');
    }

    public function sba()
    {
        return $this->_getQuery('hitting', 'sba');
    }

    public function cs()
    {
        return $this->_getQuery('hitting', 'cs');
    }

    public function hbp()
    {
        return $this->_getQuery('hitting', 'hbp');
    }

    public function sh()
    {
        return $this->_getQuery('hitting', 'sh');
    }

    public function sf()
    {
        return $this->_getQuery('hitting', 'sf');
    }

    public function gdp()
    {
        return $this->_getQuery('hitting', 'gdp');
    }

    public function k()
    {
        return $this->_getQuery('hitting', 'so');
    }

    public function getValues()
    {
        // TODO: Implement getValues() method.
    }
}
