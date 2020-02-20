<?php

namespace App\Classes\Stats\Sports\BasketballGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;

/**
 * Class GameByGame
 * @package App\Classes\Stats\Sports\FootballGame
 */
class GameByGame extends AbstractGame
{

    public function min()
    {
        return $this->_getQuery('stats', 'min');
    }

    public function fgm()
    {
        return $this->_getQuery('stats', 'fgm');
    }

    public function fga()
    {
        return $this->_getQuery('stats', 'fga');
    }

    public function fgmApct()
    {
        $fgm = $this->fgm();
        $fga = $this->fga();

        return ((float)$fga > 0 ? (($fgm / $fga) * 100) : 0);
    }

    public function threeFgA()
    {
        return $this->_getQuery('stats', 'fga3');
    }

    public function threeFgM()
    {
        return $this->_getQuery('stats', 'fgm3');
    }

    public function threeFgApct()
    {
        $fgm = $this->threeFgM();
        $fga = $this->threeFgA();

        return ((float)$fga > 0? (($fgm / $fga) * 100) : 0);
    }

    public function ftmM()
    {
        return $this->_getQuery('stats', 'ftm');
    }

    public function ftmA()
    {
        return $this->_getQuery('stats', 'fta');
    }

    public function ftmAPct()
    {
        $ftm = $this->ftmM();
        $fta = $this->ftmA();

        return ((float)$fta > 0? (($ftm / $fta) * 100) : 0);
    }

    public function off()
    {
        return $this->_getQuery('stats', 'oreb');
    }

    public function def()
    {
        return $this->_getQuery('stats', 'dreb');
    }

    public function total()
    {
        return ($this->off() + $this->def());
    }

    public function pf()
    {
        return $this->_getQuery('stats', 'pf');
    }

    public function ast()
    {
        return $this->_getQuery('stats', 'ast');
    }

    public function to()
    {
        return $this->_getQuery('stats', 'to');
    }

    public function blk()
    {
        return $this->_getQuery('stats', 'blk');
    }

    public function stl()
    {
        return $this->_getQuery('stats', 'stl');
    }

    public function pts()
    {
        return $this->_getQuery('stats', 'tp');
    }


    public function getValues()
    {
        // TODO: Implement getValues() method.
    }
}
