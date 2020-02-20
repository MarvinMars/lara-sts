<?php

namespace App\Classes\Stats\Sports\Career\IceHockey;

use App\Classes\Stats\Sports\Career\AbstractCareer;

class OverallStats extends AbstractCareer
{
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
        return $this->g() + $this->a();
    }

    public function sh()
    {
        return $this->_sumByGroupKey('shots', 'sh');
    }

    public function shpct()
    {
        $sh = $this->sh();
        $g = $this->g();

        if ($sh > 0) {
            return number_format($g / $sh, 3);
        }

        return '--';
    }

    public function plusMinus()
    {
        $value = $this->_sumByGroupKey('misc', 'plusminus');

        if ($value > 0) {
            return '+' . $value;
        }

        return $value;
    }

    public function penaltyMin()
    {
        $penCount = $this->_sumByGroupKey('penalty', 'count');
        //playerData[x]['penalty']['minutes']
        $min = $this->_sumByGroupKey('penalty', 'minutes');

        return $penCount . '-' . $min;
    }

    public function minors()
    {
        return $this->_sumByGroupKey('penalty', 'minor');
    }

    public function majors()
    {
        return $this->_sumByGroupKey('penalty', 'major');
    }

    public function penaltyOthers()
    {
        $misc10 = $this->_sumByGroupKey('penalty', 'misc10');
        $miscGame = $this->_sumByGroupKey('penalty', 'miscgame');
        $miscGross = $this->_sumByGroupKey('penalty', 'miscgross');
        $miscMatch = $this->_sumByGroupKey('penalty', 'match');

        return $misc10 + $miscGame + $miscGross + $miscMatch;
    }

    public function powerPlay()
    {
        return $this->_sumByGroupKey('goaltype', 'pp');
    }

    public function shorthand()
    {
        return $this->_sumByGroupKey('goaltype', 'sh');
    }

    public function fg()
    {
        return $this->_sumByGroupKey('goaltype', 'fg');
    }

    public function gw()
    {
        return $this->_sumByGroupKey('goaltype', 'gw');
    }

    public function gt()
    {
        return $this->_sumByGroupKey('goaltype', 'gt');
    }

    public function ot()
    {
        return $this->_sumByGroupKey('goaltype', 'ot');
    }

    public function ht()
    {
        return $this->_sumByGroupKey('goaltype', 'ht');
    }

    public function pn()
    {
        return $this->_sumByGroupKey('goaltype', 'pn');
    }

    public function ua()
    {
        return $this->_sumByGroupKey('goaltype', 'ua');
    }

    public function blk()
    {
        return $this->_sumByGroupKey('misc', 'blk');
    }
}
