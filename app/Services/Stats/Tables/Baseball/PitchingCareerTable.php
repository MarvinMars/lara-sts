<?php

namespace App\Services\Stats\Tables\Baseball;


use App\Models\PlayerValue;
use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\Baseball\BaseballPitchingTrait;
use App\Services\Stats\Traits\CareerQueryTrait;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Pitching
 * @package App\Services\Stats\Tables\IceHockey
 */
class PitchingCareerTable extends AbstractTable
{
    use CareerQueryTrait, BaseballPitchingTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     *
     */
    protected function build(): array
    {
        return [
            $this->gp(), // gp
            $this->era(), //era
            $this->winLoss(), //w-l
            $this->gameStarted(), //gs
            $this->completeGame(), //cg
            $this->inningsPitched(), //IP
            $this->hits(), //H
            $this->runs(), //R
            $this->homeRuns(), //HR
            $this->earnedRuns(), //ER
            $this->sacrificeFlyAllowed(), //SFA
            $this->baseOnBalls(), //BB
            $this->strikeOut(), //SO
            $this->wildPitch(), //WP
            $this->balk(), //BK
            $this->hitsByPitch(), //HBP
            $this->battersFaced(), //BF
            $this->double(), //2B
            $this->triple(), //3B
            $this->fly(), //FO
            $this->ground(), //GO
            $this->npStk(), //NP/STK
        ];
    }
}