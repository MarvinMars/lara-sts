<?php

namespace App\Services\Stats\Tables\IceHockey;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\GameByGameQueryTrait;
use App\Services\Stats\Traits\IceHockey\OverallTrait;


class GameByGameTable extends AbstractTable
{
    use GameByGameQueryTrait, OverallTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     *
     */
    protected function build(): array
    {
        return [
            $this->goals(),
            $this->assist(),
            $this->pts(),
            $this->shots(),
            $this->shotsPct(),
            $this->shortHandedGoals(),
            $this->plusMinus(),
            $this->penaltyMin(),
            $this->powerPlayGoals(),
            $this->emptyNetGoals(),
            $this->gameWinningGoals(),
            $this->gameTyingGoals(),
            $this->unassistedGoal(),
            $this->blockedShots(),
            $this->faceLost(),
            $this->faceWon(),
        ];
    }

}
