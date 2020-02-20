<?php

namespace App\Classes\Stats\Sports\Highs;

class SoftballHighs extends AbstractHighs
{
    /**
     * @return mixed
     */
    protected function hits()
    {
        return $this->_getQuery('hitting', 'h');
    }

    /**
     * @return mixed
     */
    protected function doubles()
    {
        return $this->_getQuery('hitting', 'double');
    }

    /**
     * @return mixed
     */
    protected function triples()
    {
        return $this->_getQuery('hitting', 'triple');
    }

    /**
     * @return mixed
     */
    protected function homeRuns()
    {
        return $this->_getQuery('hitting', 'hr');
    }

    /**
     * @return mixed
     */
    protected function runsScored()
    {
        return $this->_getQuery('hitting', 'r');
    }

    /**
     * @return mixed
     */
    protected function runsBattedIn()
    {
        return $this->_getQuery('hitting', 'rbi');
    }

    /**
     * @return mixed
     */
    protected function basesStolen()
    {
        return $this->_getQuery('hitting', 'sb');
    }

    /**
     * @return mixed
     */
    protected function assist()
    {
        return $this->_getQuery('hitting', 'a');
    }

    /**
     * @return mixed
     */
    protected function putouts()
    {
        return $this->_getQuery('hitting', 'po');
    }

    protected function inningPitched()
    {
        return $this->_getQuery('pitching', 'ip');
    }

    protected function strikeouts()
    {
        return $this->_getQuery('pitching', 'so');
    }
}
