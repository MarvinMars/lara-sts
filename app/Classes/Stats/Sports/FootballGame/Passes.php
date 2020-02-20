<?php

namespace App\Classes\Stats\Sports\FootballGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;

/**
 * Class Pass
 * @package App\Classes\Stats\Sports\FootballGame
 */
class Passes extends AbstractGame
{

    public function getValues()
    {
        return [
            $this->qbh(),
            $this->brk(),
        ];
    }

    private function qbh()
    {
        return $this->_getQuery('defense', 'qbh');
    }

    private function brk()
    {
        return $this->_getQuery('defense', 'brup');
    }
}
