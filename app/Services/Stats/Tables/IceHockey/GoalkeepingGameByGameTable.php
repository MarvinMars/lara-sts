<?php

namespace App\Services\Stats\Tables\IceHockey;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\GameByGameQueryTrait;
use App\Services\Stats\Traits\IceHockey\GoalieTrait;


class GoalkeepingGameByGameTable extends AbstractTable
{
    use GameByGameQueryTrait, GoalieTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     *
     */
    protected function build(): array
    {
        return [
            $this->gameDuration(),
            $this->minutes(),
            $this->goalsAllowed(),
            $this->gaa(),
            $this->saves(),
            $this->wins(),
            $this->loses(),
            $this->ties(),
            $this->powerPlayGoals(),
            $this->shortHandedGoals(),
            $this->emptyNetGoals()
        ];
    }
}