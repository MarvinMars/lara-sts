<?php

namespace App\Services\Stats\Tables\Football;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;
use App\Services\Stats\Traits\Football\DefensiveTrait;
use App\Services\Stats\Traits\Football\InterceptionsTrait;

class CareerInterceptionsTable extends AbstractTable
{
    use CareerQueryTrait, DefensiveTrait, InterceptionsTrait;

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
            $this->intsTotal(),
            $this->intsYds(),
            $this->interceptionsTouchdowns(),
            $this->interceptionsLong(),
            $this->defenseAvgR(),
            $this->defenseAvgG(),
        ];

        return $result;
    }

    public function getColumns(): array
    {
        return [
            'GP',
            'NO',
            'YDS',
            'TD',
            'LONG',
            'AVG/R',
            'AVG/G',
        ];
    }


}