<?php

namespace App\Services\Stats\Tables\Baseball;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\Baseball\BaseballFieldingTrait;
use App\Services\Stats\Traits\GameByGameQueryTrait;

/**
 * Class Fielding
 * @package App\Services\Stats\Tables\IceHockey
 */
class FieldingGameByGameTable extends AbstractTable
{
    use GameByGameQueryTrait, BaseballFieldingTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     *
     */
    protected function build(): array
    {
        return [
            $this->putouts(), //PO
            $this->totalChances(), //TC
            $this->assists(), //A
            $this->errors(), //E
            $this->catcherInterference(), //CI
            $this->passedBalls(), //PB
            $this->stolenBaseAttempts(), //SBA
            $this->caughtStealing(), //CSB
            $this->triplePlays(), //TP
            $this->fieldingPercentage(), //FldPct
        ];
    }
}