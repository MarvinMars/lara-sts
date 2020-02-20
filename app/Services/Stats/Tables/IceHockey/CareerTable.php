<?php

namespace App\Services\Stats\Tables\IceHockey;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;
use App\Services\Stats\Traits\IceHockey\OverallTrait;

/**
 * Class Career
 * @package App\Services\Stats\Tables\IceHockey
 */
class CareerTable extends AbstractTable
{
    use CareerQueryTrait, OverallTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return array
     *
     */
    protected function build(): array
    {
        $result = [
            $this->gp(),
            $this->goals(),
            $this->assist(),
            $this->pts(),
            $this->shots(),
            $this->shotsPct(),
            $this->plusMinus(),
            //goals
            $this->powerPlayGoals(),
            $this->shortHandedGoals(),
            $this->gameWinningGoals(),
            //penalties
            $this->penaltyMin(),
            //blocks
            $this->blockedShots(),
        ];

        return $result;
    }
}
