<?php

namespace App\Classes\Stats\Sports\Career\Football;

use App\Classes\Stats\Sports\Career\AbstractCareer;

class InterceptionsStats extends AbstractCareer
{

    public function no()
    {
        return $this->_sumByGroupKey('defense', 'int');
    }

    public function yds()
    {
        return $this->_sumByGroupKey('defense', 'intyds');
    }

    public function td()
    {
        return $this->_sumByGroupKey('ir', 'td');
    }

    public function long()
    {
        return $this->_sumByGroupKey('ir', 'long');
    }

    public function avgR()
    {
        $no = $this->no();
        $yds = $this->yds();

        return ($no ? ($yds / $no) : 0);
    }

    public function avgG()
    {
        $gp = $this->gp();
        $yds = $this->yds();

        return ($gp ? ($yds / $gp) : 0);
    }
}
