<?php

namespace App\Classes\Stats\Sports\Career\Football;

use App\Classes\Stats\Sports\Career\AbstractCareer;

class ReceivingStats extends AbstractCareer
{

    public function att()
    {
        return $this->_sumByGroupKey('rcv', 'att');
    }

    public function yds()
    {
        return $this->_sumByGroupKey('rcv', 'yds');
    }

    public function td()
    {
        return $this->_sumByGroupKey('rcv', 'td');
    }

    public function long()
    {
        return $this->_maxByGroupKey('rcv', 'long');
    }

    public function no()
    {
        return $this->_sumByGroupKey('rcv', 'no');
    }

    public function avg()
    {
        $yds = $this->yds();
        $no = $this->no();

        return (($yds && $no) ? ($yds / $no) : 0);
    }

    public function avgG()
    {
        $yds = $this->yds();
        $gp = $this->gp();

        return ($gp ? ($yds / $gp) : 0);
    }
}
