<?php

namespace App\Classes\Stats\Sports\FootballGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;

/**
 * Class Pats
 * @package App\Classes\Stats\Sports\FootballGame
 */
class Pats extends AbstractGame
{

    public function getValues()
    {
        return [
            $this->rush(),
            $this->rcv(),
            $this->saf(),
        ];
    }

    private function rush()
    {
    }

    private function rcv()
    {
    }

    private function saf()
    {
    }
}
