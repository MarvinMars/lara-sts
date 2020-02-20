<?php

namespace App\Classes\Stats\Sports\Highs;

class FootballHighs extends AbstractHighs
{
    protected function rushingYards()
    {
        return $this->_getQuery('rush', 'yds');
    }

    protected function longestRush()
    {
        return $this->_getQuery('rush', 'long');
    }

    protected function rushingTouchdowns()
    {
        return $this->_getQuery('rush', 'td');
    }

    protected function receptionYards()
    {
        return $this->_getQuery('rcv', 'yds');
    }

    protected function longestReception()
    {
        return $this->_getQuery('rcv', 'long');
    }

    protected function receivingTouchdowns()
    {
        return $this->_getQuery('rcv', 'td');
    }

    protected function passingYards()
    {
        return $this->_getQuery('pass', 'yds');
    }

    protected function longestPass()
    {
        return $this->_getQuery('pass', 'long');
    }

    protected function passingTouchdowns()
    {
        return $this->_getQuery('pass', 'td');
    }
}
