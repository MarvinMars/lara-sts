<?php

namespace App\Classes\Stats\Sports\Career\Football;

use App\Classes\Stats\Sports\Career\AbstractCareer;

class AllPurposeStats extends AbstractCareer
{
    public function rush()
    {
        return $this->_sumByGroupKey('rush', 'yds');
    }

    public function rcv()
    {
        return $this->_sumByGroupKey('rcv', 'yds');
    }

    public function pr()
    {
        return $this->_sumByGroupKey('pr', 'yds');
    }

    public function kr()
    {
        return $this->_sumByGroupKey('kr', 'yds');
    }

    public function ir()
    {
        return $this->_sumByGroupKey('ir', 'yds');
    }

    public function tot()
    {
        return ($this->rush() + $this->rcv() + $this->pr() + $this->kr() + $this->ir());
    }

    public function avgG()
    {
        $tot = $this->tot();
        $gp = $this->gp();

        return ($gp && $tot ? ($tot / $gp) : 0);
    }
}
