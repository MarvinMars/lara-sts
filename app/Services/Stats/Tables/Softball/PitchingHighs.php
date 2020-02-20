<?php

namespace App\Services\Stats\Tables\Softball;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\HighsQueryTrait;

/**
 * Class PitchingHighs
 * @package App\Services\Stats\Tables\Baseball
 */
class PitchingHighs extends AbstractTable
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
            'inningPitched',
            'strikeouts',
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

    protected function inningPitched()
    {
        return $this->first('pitching', 'ip');
    }

    protected function strikeouts()
    {
        return $this->first('pitching', 'so');
    }
}