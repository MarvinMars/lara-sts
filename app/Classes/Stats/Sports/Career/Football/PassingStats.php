<?php

namespace App\Classes\Stats\Sports\Career\Football;

use App\Classes\Stats\Sports\Career\AbstractCareer;

class PassingStats extends AbstractCareer
{

    public function cmp()
    {
        return $this->_sumByGroupKey('pass', 'comp');
    }

    public function att()
    {
        return $this->_sumByGroupKey('pass', 'att');
    }

    public function int()
    {
        return $this->_sumByGroupKey('pass', 'int');
    }

    public function yds()
    {
        return $this->_sumByGroupKey('pass', 'yds');
    }

    public function td()
    {
        return $this->_sumByGroupKey('pass', 'td');
    }

    public function long()
    {
        return $this->_maxByGroupKey('pass', 'long');
    }

    public function percent()
    {
        $cmp = $this->cmp();
        $att = $this->att();

        return (($cmp && $att) ? (($cmp / $att) * 100) : 0);
    }

    public function avgP()
    {
        $yds = $this->yds();
        $att = $this->att();

        return ($yds && $att ? ($yds / $att) : 0);
    }

    public function avgG()
    {
        $yds = $this->yds();
        $gp = $this->gp();

        return ($gp ? ($yds / $gp) : 0);
    }

    /**
     * @return int
     *
     * @formula [ { (8.4 * yards) + (330 * touchdowns) - (200 * interceptions) + (100 * completions) } / attempts ]
     */
    public function effic()
    {
        $att = $this->att();

        $effic = 0;

        if ($att) {
            $effic = ((8.4 * $this->yds() + (330 * $this->td()) - (200 * $this->int()) + (100 * $this->cmp())) / $att);
        }


        return $effic;
    }
}
