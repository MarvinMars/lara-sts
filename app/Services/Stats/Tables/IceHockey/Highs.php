<?php

namespace App\Services\Stats\Tables\IceHockey;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\HighsQueryTrait;

/**
 * Class Highs
 * @package App\Services\Stats\Tables\IceHockey
 */
class Highs extends AbstractTable
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
            'shots',
            'goals',
            'assists',
            'blocked',
            'penaltiesMin',
            'plusMinus'
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
     * @return \App\Models\PlayerValue
     */
    protected function shots()
    {
        return $this->first('shots', 'sh');
    }

    /**
     * @return \App\Models\PlayerValue
     */
    protected function goals()
    {
        return $this->first('shots', 'g');
    }

    /**
     * @return \App\Models\PlayerValue
     */
    protected function assists()
    {
        return $this->first('shots', 'a');
    }

    /**
     * @return \App\Models\PlayerValue
     */
    protected function blocked()
    {
        return $this->first('misc', 'blk');
    }

    /**
     * @return \App\Models\PlayerValue
     */
    protected function penaltiesMin()
    {
        return $this->first('penalty', 'minutes');
    }

    /**
     * @return \App\Models\PlayerValue
     */
    protected function plusMinus()
    {
        return $this->first('misc', 'plusminus');
    }
}
