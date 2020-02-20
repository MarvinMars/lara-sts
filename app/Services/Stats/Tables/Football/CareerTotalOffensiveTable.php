<?php

namespace App\Services\Stats\Tables\Football;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;
use App\Services\Stats\Traits\Football\PassingTrait;
use App\Services\Stats\Traits\Football\RushingTrait;

class CareerTotalOffensiveTable extends AbstractTable
{
    use CareerQueryTrait, PassingTrait, RushingTrait;

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
            $this->rushingYds(),
            $this->passingYds(),
            $this->totalOffensive(),
            $this->averageTotalPerGame(),
        ];

        return $result;
    }

    public function getColumns(): array
    {
        return [
            'GP',
            'RUSH',
            'PASS',
            'TOTAL',
            'AVG/G',
        ];
    }


    /**
     * @param bool $format
     *
     * @return float|string
     */
    public function totalOffensive(bool $format = true)
    {
        $result = $this->rushingYds(false) + $this->passingYds(false);


        return $format ? number_format($result) : $result;
    }

    /**
     * @return string
     */
    public function averageTotalPerGame()
    {
        $gp = $this->gp();
        $total = $this->totalOffensive(false);

        $result = ((float)$gp > 0 ? ($total / $gp) : 0);

        return number_format($result, 1);
    }


}