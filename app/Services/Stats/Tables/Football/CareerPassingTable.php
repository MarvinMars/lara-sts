<?php

namespace App\Services\Stats\Tables\Football;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;
use App\Services\Stats\Traits\Football\PassingTrait;

class CareerPassingTable extends AbstractTable
{
    use CareerQueryTrait, PassingTrait;

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
            $this->passingCmp(),
            $this->passingAtt(),
            $this->passingInt(),
            $this->passingYds(),
            $this->passingTd(),
            $this->passingLong(),
            $this->passingPercent(),
            $this->passingAvgP(),
            $this->passingAvgG(),
            $this->passingEffic()

        ];

        return $result;
    }

    public function getColumns(): array
    {
        return [
            'GP',
            'CMP',
            'ATT',
            'INT',
            'YDS',
            'TD',
            'Long',
            '%',
            'AVG/P',
            'AVG/G',
            'EFFIC',
        ];
    }


}