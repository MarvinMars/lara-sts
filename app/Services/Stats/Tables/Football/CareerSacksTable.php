<?php

namespace App\Services\Stats\Tables\Football;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;
use App\Services\Stats\Traits\Football\DefensiveTrait;

class CareerSacksTable extends AbstractTable
{
    use CareerQueryTrait, DefensiveTrait;

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
            $this->sacksUa(),
            $this->sacksA(),
            $this->sacksTotal(),
            $this->sacksYds()
        ];

        return $result;
    }

    public function getColumns(): array
    {
        return [
            'GP',
            'UA',
            'A',
            'TOTAL',
            'YDS',
        ];
    }


}