<?php

namespace App\Classes\Stats\Sports\FootballGame;


use App\Classes\Stats\Sports\Abstracts\AbstractGame;

/**
 * Class Blocks
 * @package App\Classes\Stats\Sports\FootballGame
 */
class Blocks extends AbstractGame
{

    public function getValues()
    {
        return [
            $this->kick(),
        ];
    }

    private function kick()
    {
        return $this->_getQuery('defense', 'blkd');
    }
}
