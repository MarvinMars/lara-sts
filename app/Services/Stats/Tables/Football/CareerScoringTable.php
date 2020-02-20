<?php

namespace App\Services\Stats\Tables\Football;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;
use App\Services\Stats\Traits\Football\ScoringTrait;

class CareerScoringTable extends AbstractTable
{
    use CareerQueryTrait, ScoringTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return array
     *
     */
    protected function build(): array
    {
        $result = [
            $this->gp(), //GP
            $this->scoringTd(),
            $this->scoringRush(),
            $this->scoringRec(),
            $this->scoringRet(),
            $this->scoringFg(),
            $this->scoringPat(),
            $this->scoringTot(),
            $this->scoringAvgG(),

        ];

        return $result;
    }

    public function getColumns(): array
    {
        return [
            'GP',
            'TD',
            'RUSH',
            'REC',
            'RET',
            'FG',
            'PAT',
            'TOTAL',
            'AVG/G',
        ];
    }


}