<?php

namespace App\Services\Stats\Tables\Football;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;
use App\Services\Stats\Traits\Football\ReceivingTrait;

class CareerReceivingTable extends AbstractTable
{
    use CareerQueryTrait, ReceivingTrait;

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
            $this->receivingNo(),
            $this->receivingYds(),
            $this->receivingAvg(),
            $this->receivingTd(),
            $this->receivingLong(),
            $this->receivingAvgG(),
        ];

        return $result;
    }

    public function getColumns(): array
    {
        return [
            'GP',
            'NO',
            'YDS',
            'AVG',
            'TD',
            'LONG',
            'AVG/G',
        ];
    }


}