<?php

namespace App\Classes\Stats\Sports\Highs;

class LacrosseHighs extends AbstractHighs
{

    public function shots()
    {
        return $this->_getQuery('shots', 'sh');
    }


    public function shotsOnGoal()
    {
        return $this->_getQuery('shots', 'sog');
    }


    public function goals()
    {
        return $this->_getQuery('shots', 'g');
    }

    public function assists()
    {
        return $this->_getQuery('shots', 'a');
    }

    public function minutes()
    {
        return $this->_getQuery('misc', 'minutes');
    }

    public function shotsFaced()
    {
        return $this->_getQuery('goalie', 'sf');
    }

    public function saves()
    {
        return $this->_getQuery('goalie', 'saves');
    }

    public function goalsAllowed()
    {
        return $this->_getQuery('goalie', 'ga');
    }
}
