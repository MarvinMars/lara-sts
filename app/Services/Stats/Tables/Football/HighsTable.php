<?php

namespace App\Services\Stats\Tables\Football;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\HighsQueryTrait;

/**
 * Class HighsTable
 * @package App\Services\Stats\Tables\Baseball
 */
class HighsTable extends AbstractTable
{
    use HighsQueryTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     */
    protected function build(): array
    {
        $data = [
            'rushingYards',
            'longestRush',
            'rushingTouchdowns',
            'receptionYards',
            'longestReception',
            'receivingTouchdowns',
            'passingYards',
            'longestPass',
            'passingTouchdowns',
        ];

        $result = [];

        foreach ($data as $item) {
            $rushValue = $this->get($item);

            if (null !== $rushValue) {
                $result[] = $rushValue;
            }
        }

        return $result;
    }

    protected function rushingYards()
    {
        return $this->first('rush', 'yds');
    }

    protected function longestRush()
    {
        return $this->first('rush', 'long');
    }

    protected function rushingTouchdowns()
    {
        return $this->first('rush', 'td');
    }

    protected function receptionYards()
    {
        return $this->first('rcv', 'yds');
    }

    protected function longestReception()
    {
        return $this->first('rcv', 'long');
    }

    protected function receivingTouchdowns()
    {
        return $this->first('rcv', 'td');
    }

    protected function passingYards()
    {
        return $this->first('pass', 'yds');
    }

    protected function longestPass()
    {
        return $this->first('pass', 'long');
    }

    protected function passingTouchdowns()
    {
        return $this->first('pass', 'td');
    }
}