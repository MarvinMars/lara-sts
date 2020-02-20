<?php

namespace App\Services\Stats\Tables\Baseball;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\Baseball\BaseballPitchingTrait;
use App\Services\Stats\Traits\GameByGameQueryTrait;

/**
 * Class PitchingGameByGameTable
 * @package App\Services\Stats\Tables\Baseball
 */
class PitchingGameByGameTable extends AbstractTable
{
    use GameByGameQueryTrait, BaseballPitchingTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     *
     */
    protected function build(): array
    {
        return [
            $this->gp(), //gp
            $this->gameStarted(), //gs
            $this->completeGame(), //cg
            $this->inningsPitched(), //IP
            $this->hits(), //H
            $this->runs(), //R
            $this->earnedRuns(), //ER
            $this->baseOnBalls(), //BB
            $this->strikeOut(), //SO
            $this->shotouts(), //SHO
            $this->battersFaced(), //BF
            $this->double(), //2B
            $this->triple(), //3B
            $this->balk(), //BK
            $this->homeRuns(), //HR
            $this->wildPitch(), //WP
            $this->hitsByPitch(), //HBP
            $this->sacrificeFlyAllowed(), //SFA
            $this->ground(), //GO
            $this->fly(), //FO
            $this->npStk(), //NP/STK
        ];
    }
}