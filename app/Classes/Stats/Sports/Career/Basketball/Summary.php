<?php

namespace App\Classes\Stats\Sports\Career\Basketball;

use App\Classes\Stats\Sports\Career\AbstractCareer;

class Summary extends AbstractCareer
{
    public function min()
    {
        return $this->_sumByGroupKey('stats', 'min');
    }

    public function minAvg()
    {

    }

    public function totalFgm()
    {
        return $this->_sumByGroupKey('stats', 'fgm');
    }

    public function totalFga()
    {
        return $this->_sumByGroupKey('stats', 'fga');
    }

    public function totalPct()
    {
        $fgm = $this->totalFgm();
        $fga = $this->totalFga();

        return ($fga ? (($fgm / $fga) * 100) : 0);
    }

    public function tpFgm()
    {
        return $this->_sumByGroupKey('stats', 'fgm3');
    }

    public function tpFga()
    {
        return $this->_sumByGroupKey('stats', 'fga3');
    }

    public function tpPct()
    {
        $fgm = $this->tpFgm();
        $fga = $this->tpFga();

        return ($fga ? (($fgm / $fga) * 100) : 0);
    }

    public function ftFtm()
    {
        return $this->_sumByGroupKey('stats', 'ftm');
    }

    public function ftFta()
    {
        return $this->_sumByGroupKey('stats', 'fta');
    }

    public function ftPct()
    {
        $fgm = $this->ftFtm();
        $fga = $this->ftFta();

        return ($fga ? (($fgm / $fga) * 100) : 0);
    }

    public function rebOff()
    {
        return $this->_sumByGroupKey('stats', 'oreb');
    }

    public function rebDef()
    {
        return $this->_sumByGroupKey('stats', 'dreb');
    }

    public function rebTot()
    {
        return $this->rebOff() + $this->rebDef();
    }

    public function rebAvg()
    {
    }

    public function pf()
    {
        return $this->_sumByGroupKey('stats', 'pf');
    }

    public function fo()
    {
    }

    public function ast()
    {
        return $this->_sumByGroupKey('stats', 'ast');
    }

    public function to()
    {
        return $this->_sumByGroupKey('stats', 'to');
    }

    public function blk()
    {
        return $this->_sumByGroupKey('stats', 'blk');
    }

    public function stl()
    {
        return $this->_sumByGroupKey('stats', 'stl');
    }

    public function pts()
    {
        return $this->_sumByGroupKey('stats', 'tp');
    }

    public function avg()
    {
    }
}
