<?php

namespace App\Classes\Stats\Sports\Career\Lacrosse;

use App\Classes\Stats\Sports\Career\AbstractCareer;

class LacrosseStats extends AbstractCareer
{

    public function min()
    {
        return $this->_sumByGroupKey('misc', 'minutes');
    }

    public function ga()
    {
        return $this->_sumByGroupKey('goalie', 'ga');
    }

    public function gaAvg()
    {
        $min = $this->min();
        $ga = $this->ga();

        return (($ga && $min) ? (($ga * 90) / $min) : 0);
    }

    public function sv()
    {
        return $this->_sumByGroupKey('goalie', 'saves');
    }

    public function svPercent()
    {
        $sog = $this->sog();
        $sv = $this->sv();

        return (($sog && $sv) ? ($sv / $sog) : 0);
    }

    public function sho()
    {
        return $this->_sumByGroupKey('goalie', 'shutout');
    }

    public function sf()
    {
        return $this->_sumByGroupKey('goalie', 'sf');
    }

    public function sog()
    {
        return $this->_sumByGroupKey('shots', 'sog');
    }

    public function gs()
    {
        return $this->_sumByGroupKey('player', 'gs');
    }

    public function g()
    {
        return $this->_sumByGroupKey('shots', 'g');
    }

    public function a()
    {
        return $this->_sumByGroupKey('shots', 'a');
    }

    public function pts()
    {
        return $this->_sumByGroupKey('shots', 'ps');
    }

    public function sh()
    {
        return $this->_sumByGroupKey('shots', 'sh');
    }

    public function shPercent()
    {
        $g = $this->g();
        $sh = $this->sh();

        return (($g && $sh) ? ($g / $sh) : 0);
    }

    public function sogPercent()
    {
        $g = $this->g();
        $sog = $this->sog();

        return (($sog && $g) ? ($g / $sog) : 0);
    }

    public function gw()
    {
        return $this->_sumByGroupKey('goaltype', 'gw');
    }

    public function pkAtt()
    {
        return $this->_sumByGroupKey('shots', 'psatt');
    }
}
