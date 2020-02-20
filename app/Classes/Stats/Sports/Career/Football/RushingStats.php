<?php

namespace App\Classes\Stats\Sports\Career\Football;

use App\Classes\Stats\Sports\Career\AbstractCareer;

class RushingStats extends AbstractCareer
{

    public function att()
    {
        return $this->_sumByGroupKey('rush', 'att');
    }

    public function yds()
    {
        return $this->_sumByGroupKey('rush', 'yds');
    }

    public function td()
    {
        return $this->_sumByGroupKey('rush', 'td');
    }

    public function long()
    {
        return $this->_maxByGroupKey('rush', 'long');
    }

    public function avgA()
    {
        $yds = $this->yds();
        $att = $this->att();

        return ($att ? ($yds / $att) : 0);
    }

    public function avgG()
    {
        $yds = $this->yds();
        $gp = $this->gp();

        return ($gp ? ($yds / $gp) : 0);
    }

    public function gain()
    {
        return $this->_sumByGroupKey('rush', 'gain');
    }

    public function loss()
    {
        return $this->_sumByGroupKey('rush', 'loss');
    }
}
