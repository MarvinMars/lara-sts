<?php

namespace App\Services\Stats\Tables\IceHockey;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;
use App\Services\Stats\Traits\IceHockey\GoalieTrait;

/**
 * Class Career
 * @package App\Services\Stats\Tables\IceHockey
 */
class GoalkeepingCareerTable extends AbstractTable
{
    use CareerQueryTrait, GoalieTrait;

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
            $this->wins(),
            $this->loses(),
            $this->ties(),
            $this->minutes(),
            $this->powerPlayGoals(),
            $this->saves(),
            $this->goalsAllowed(),
            $this->gaa(),
        ];

        return $result;
    }
}