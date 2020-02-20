<?php

namespace App\Services\Stats\Tables\Football;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;
use App\Services\Stats\Traits\Football\RushingTrait;

class CareerRushingTable extends AbstractTable
{
    use CareerQueryTrait, RushingTrait;

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
            $this->rushingAtt(),
            $this->rushingGain(),
            $this->rushingLoss(),
            $this->rushingYds(),
            $this->rushingAvgA(),
            $this->rushingTd(),
            $this->rushingLong(),
            $this->rushingAvgG()
        ];

        return $result;
    }

    public function getColumns(): array
    {
        return [
            'GP',
            'ATT',
            'GAIN',
            'LOSS',
            'YDS',
            'AVG',
            'TD',
            'LONG',
            'AVG/G',
        ];
    }


}