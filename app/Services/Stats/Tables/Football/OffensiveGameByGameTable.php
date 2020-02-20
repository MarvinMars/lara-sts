<?php

namespace App\Services\Stats\Tables\Football;

use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\Football\PassingTrait;
use App\Services\Stats\Traits\Football\ReceivingTrait;
use App\Services\Stats\Traits\Football\RushingTrait;
use App\Services\Stats\Traits\GameByGameQueryTrait;

class OffensiveGameByGameTable extends AbstractTable
{
    use GameByGameQueryTrait, ReceivingTrait, RushingTrait, PassingTrait;

    public function getColumns(): array
    {
        return array_merge($this->getPassingColumns(), $this->getRushingColumns(), $this->getReceivingColumns());
    }

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     */
    protected function build(): array
    {
        return array_merge($this->getPassingData(), $this->getRushingData(), $this->getReceivingData());
    }

    /**
     * @return array
     */
    private function getPassingColumns(): array
    {
        if (!$this->player->isHaveBlocks('offensive_passing_group')) {
            return [];
        }
        return [
            'CMP',
            'ATT',
            'YDS',
            'TD',
            '%',
            'INT',
            'LONG',
        ];


    }

    /**
     * @return array
     */
    private function getRushingColumns()
    {
        if (!$this->player->isHaveBlocks('offensive_rushing_group')) {
            return [];
        }

        return [
            'ATT',
            'YDS',
            'TD',
            'Long',
        ];
    }

    /**
     * @return array
     */
    private function getReceivingColumns()
    {
        if (!$this->player->isHaveBlocks('offensive_receiving_group')) {
            return [];
        }

        return [
            'NO',
            'YDS',
            'AVG',
            'TD',
            'LONG',
        ];
    }

    /**
     * @return array
     */
    private function getPassingData(): array
    {
        if (!$this->player->isHaveBlocks('offensive_passing_group')) {
            return [];
        }

        return [
            $this->passingCmp(),
            $this->passingAtt(),
            $this->passingYds(),
            $this->passingTd(),
            $this->passingPercent(),
            $this->passingInt(),
            $this->passingLong(),
        ];
    }

    /**
     * @return array
     */
    private function getRushingData(): array
    {
        if (!$this->player->isHaveBlocks('offensive_rushing_group')) {
            return [];
        }

        return [
            $this->rushingAtt(),
            $this->rushingYds(),
            $this->rushingTd(),
            $this->rushingLong(),
        ];
    }

    /**
     * @return array
     */
    private function getReceivingData(): array
    {
        if (!$this->player->isHaveBlocks('offensive_receiving_group')) {
            return [];
        }

        return [
            $this->receivingNo(),
            $this->receivingYds(),
            $this->receivingAvg(),
            $this->receivingTd(),
            $this->receivingLong(),
        ];
    }
}
