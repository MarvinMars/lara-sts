<?php

namespace App\Classes\Stats\Sports\FootballGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Receiving
 * @package App\Classes\Stats\Sports\FootballGame
 */
class Receiving extends AbstractGame
{
    public function att()
    {
        return $this->_getQuery('rcv', 'att');
    }

    public function yds()
    {
        return $this->_getQuery('rcv', 'yds');
    }

    public function td()
    {
        return $this->_getQuery('rcv', 'td');
    }

    public function long()
    {
        return $this->_getMaxQuery('rcv', 'long');
    }

    public function no()
    {
        return $this->_getQuery('rcv', 'no');
    }

    public function avg()
    {
        $yds = $this->yds();
        $no = $this->no();

        return (($yds && (float)$no > 0) ? ($yds / $no) : 0);
    }

    public function getValues()
    {
        return [
            $this->no(),
            $this->yds(),
            number_format($this->avg(), 1),
            $this->td(),
            $this->long(),
        ];
    }
}
