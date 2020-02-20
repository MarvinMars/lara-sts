<?php

namespace App\Services\Stats\Tables\Baseball;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\Baseball\BaseballHittingTrait;
use App\Services\Stats\Traits\CareerQueryTrait;

/**
 * Class HittingCareerTable
 * @package App\Services\Stats\Tables\Baseball
 */
class HittingCareerTable extends AbstractTable
{
    use CareerQueryTrait, BaseballHittingTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     *
     */
    protected function build(): array
    {
        return [
            $this->gp(), //GP
            $this->battingAverage(), //BA
            $this->OBPct(), //OBPct
            $this->sluggingAverage(), //SlgPct
            $this->runsScored(), //R
            $this->atBats(), //AB
            $this->hits(), //H
            $this->double(), //2B
            $this->triple(), //3B
            $this->totalBases(), //TB
            $this->homeRuns(), //HR
            $this->runBattedIn(), //RBI
            $this->baseOnBalls(), //BB
            $this->hitsByPitch(), //HBP
            $this->sacrificeFly(), //SF
            $this->sacrificeHit(), //SH
            $this->strikeOut(), //K
            $this->caughtStealing(), //CS
            $this->stolenBase(), //SB
        ];
    }
}