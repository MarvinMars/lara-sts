<?php

namespace App\Services\Stats\Tables\Football;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;
use App\Services\Stats\Traits\Football\InterceptionsTrait;
use App\Services\Stats\Traits\Football\ReceivingTrait;
use App\Services\Stats\Traits\Football\RushingTrait;

class CareerAllPurposeTable extends AbstractTable
{
    use CareerQueryTrait, RushingTrait, ReceivingTrait, InterceptionsTrait;

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
            $this->receivingYds(),
            $this->prYds(),
            $this->krYds(),
            $this->interceptionsYds(),
            $this->totalYds(),
            $this->avgGYds()
        ];

        return $result;
    }

    public function getColumns(): array
    {
        return [
            'GP',
            'RUSH',
            'RCV',
            'PR',
            'KR',
            'IR',
            'TOT',
            'AVG/G',
        ];
    }

    /**
     * @param bool $format
     *
     * @return float|string
     */
    public function prYds(bool $format = true)
    {
        return $this->sum('pr', 'yds', $format);
    }

    /**
     * @param bool $format
     *
     * @return float|string
     */
    public function krYds(bool $format = true)
    {
        return $this->sum('kr', 'yds', $format);
    }

    /**
     * @param bool $format
     *
     * @return float|string
     */
    public function totalYds(bool $format = true)
    {
        $result = ($this->rushingYds(false) + $this->receivingYds(false) + $this->prYds(false) + $this->krYds(false) + $this->interceptionsYds(false));

        return $format ? number_format($result) : $result;
    }

    /**
     * @return string
     */
    public function avgGYds()
    {
        $tot = $this->totalYds(false);
        $gp = $this->gp();

        $result = ((float)$gp > 0 ? ($tot / $gp) : 0);

        return number_format($result, 1);
    }


}