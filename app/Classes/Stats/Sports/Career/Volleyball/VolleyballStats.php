<?php

namespace App\Classes\Stats\Sports\Career\Volleyball;

use App\Classes\Stats\Sports\Career\AbstractCareer;

class VolleyballStats extends AbstractCareer
{
    /*SP	MP	K	K/S	E	TA	%	A	A/S	SA	SA/S	SE*/
    public function sp()
    {
        return $this->_sumByGroupKey('player', 'gp');
    }

    public function k()
    {
        return $this->_sumByGroupKey('attack', 'k');
    }

    public function ks()
    {
        $kills = $this->k();
        $set = $this->sp();
        return ( ((float)$set > 0)? ($kills / $set) :  $kills);
    }

    public function e()
    {
        return $this->_sumByGroupKey('attack', 'e');
    }

    public function atc_ta()
    {
        return $this->_sumByGroupKey('attack', 'ta');
    }

    public function pct()
    {
        return $this->_sumByGroupKey('attack', 'pct');
    }

    public function a()
    {
        return $this->_sumByGroupKey('set', 'a');
    }

    public function set_ta()
    {
        return $this->_sumByGroupKey('set', 'ta');
    }

    public function as()
    {
        $attempts = $this->a();
        $set = $this->sp();

        return ( ($set > 0) ? $attempts / $set : $attempts );
    }

    public function sa()
    {
        return $this->_sumByGroupKey('serve', 'sa');
    }

    public function serve_ta()
    {
        return $this->_sumByGroupKey('serve', 'ta');
    }

    public function sas()
    {
        $service_aces = $this->sa();
        $set = $this->sp();
        return ( ($set > 0)? ($service_aces / $set) :  $service_aces);
    }

    public function se()
    {
        return $this->_sumByGroupKey('serve', 'se');
    }
    /*DIG	D/S	RE	BS	BA	TB	B/S	BE	BHE	PTS	PTS/S*/
    public function dig()
    {
        return $this->_sumByGroupKey('defense', 'dig');
    }
    public function ds()
    {
        $service_aces = $this->dig();
        $set = $this->sp();
        return ( ($set > 0)? ($service_aces / $set) :  $service_aces);
    }
    public function re()
    {
        return $this->_sumByGroupKey('defense', 're');
    }
    public function bs()
    {
        return $this->_sumByGroupKey('block', 'bs');
    }
    public function ba()
    {
        return $this->_sumByGroupKey('block', 'ba');
    }
    public function tb()
    {
        return $this->_sumByGroupKey('block', 'tb');
    }
    public function b_s()
    {
        $bs = $this->bs();
        $set = $this->sp();
        return ( ($set > 0)? ($bs / $set) :  $bs);
    }
    public function be()
    {
        return $this->_sumByGroupKey('block', 'be');
    }
    public function bhe()
    {
        return $this->_sumByGroupKey('misc', 'bhe');
    }
    public function pts()
    {
        return $this->_sumByGroupKey('misc', 'pts');
    }
    public function ptss()
    {
        $pts = $this->pts();
        $set = $this->sp();
        return ( ($set > 0)? ($pts / $set) :  $pts);
    }
}
