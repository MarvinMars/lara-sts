<?php

namespace App\Classes\Stats\Sports;

use App\Classes\Stats\Sports\SoftballGame\Fielding;
use App\Classes\Stats\Sports\SoftballGame\Hitting;
use App\Models\Game;
use App\Models\Player;
use App\Models\Season;

/**
 * Stats for the baseball game
 *
 * Class BaseballGame
 * @package App\Classes\Stats\Sports
 */
class SoftballGame extends SportClass
{

    public function __construct(Player $player, Game $game, Season $season)
    {
        parent::__construct($player, $game, $season);
    }

    protected function hittingValues()
    {
        $passing = new Hitting($this->_getQuery());

        return [
            number_format($passing->gs()),
            number_format($passing->ab()),
            number_format($passing->r()),
            number_format($passing->h()),
            number_format($passing->rbi()),
            number_format($passing->twoB()),
            number_format($passing->threeB()),
            number_format($passing->hr()),
            number_format($passing->bb()),
            number_format($passing->ibb()),
            number_format($passing->sb()),
            number_format($passing->sba()),
            number_format($passing->cs()),
            number_format($passing->hbp()),
            number_format($passing->sh()),
            number_format($passing->sf()),
            number_format($passing->gdp()),
            number_format($passing->k()),
            number_format($this->player->getAvg($this->season, $this->game, 'hitting'), 3),
        ];
    }

    protected function fieldingValues()
    {
        $class = new Fielding($this->_getQuery());

        return [
            number_format($class->c()),/*not found */
            number_format($class->po()),
            number_format($class->a()),
            number_format($class->e()),
            number_format($class->fldPercent(), 3),
            number_format($class->dp()),
            number_format($class->sba()),
            number_format($class->csb()),
            number_format($class->pb()),
            number_format($class->ci()),
        ];

    }
}
