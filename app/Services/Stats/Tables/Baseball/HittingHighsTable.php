<?php

namespace App\Services\Stats\Tables\Baseball;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\HighsQueryTrait;

/**
 * Class Highs
 * @package App\Services\Stats\Tables\Baseball
 */
class HittingHighsTable extends AbstractTable
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
            'hits',
            'doubles',
            'triples',
            'homeRuns',
            'runsScored',
            'runsBattedIn',
            'basesStolen',
            'assist',
            'putouts',
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

    /**
     * @return mixed
     */
    protected function hits()
    {
        return $this->first('hitting', 'h');
    }

    /**
     * @return mixed
     */
    protected function doubles()
    {
        return $this->first('hitting', 'double');
    }

    /**
     * @return mixed
     */
    protected function triples()
    {
        return $this->first('hitting', 'triple');
    }

    /**
     * @return mixed
     */
    protected function homeRuns()
    {
        return $this->first('hitting', 'hr');
    }

    /**
     * @return mixed
     */
    protected function runsScored()
    {
        return $this->first('hitting', 'r');
    }

    /**
     * @return mixed
     */
    protected function runsBattedIn()
    {
        return $this->first('hitting', 'rbi');
    }

    /**
     * @return mixed
     */
    protected function basesStolen()
    {
        return $this->first('hitting', 'sb');
    }

    /**
     * @return mixed
     */
    protected function assist()
    {
        return $this->first('fielding', 'a');
    }

    /**
     * @return mixed
     */
    protected function putouts()
    {
        return $this->first('fielding', 'po');
    }
}
