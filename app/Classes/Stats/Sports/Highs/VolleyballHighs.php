<?php

namespace App\Classes\Stats\Sports\Highs;

class VolleyballHighs extends AbstractHighs
{

    public function gp()
    {
        return $this->_getQuery('player', 'gp');
    }

    protected function kills()
    {
        return $this->_getQuery('attack', 'k');
    }

    protected function assists()
    {
        return $this->_getQuery('set', 'a');
    }

    protected function points()
    {
        return $this->_getQuery('misc', 'pts');
    }

    protected function aces()
    {
        return $this->_getQuery('serve', 'sa');
    }

    protected function digs()
    {
        return $this->_getQuery('defense', 'dig');
    }

    protected function totalBlocks()
    {
        return $this->_getQuery('block', 'tb');
    }

}
