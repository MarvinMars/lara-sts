<?php

namespace App\Services\Stats\Tables\Soccer;

use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\HighsQueryTrait;

class HighsGoalkeeping extends AbstractTable
{
    use HighsQueryTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     *
     */
    protected function build(): array
    {

        $data = [
            'shotsFaced',           /* SF */
            'saves',                /* SAVES */
            'goalsAllowed'          /* GA */
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
     * @return string
     *
     */

    public function shotsFaced()
    {
        return $this->first('goalie', 'sf');
    }

    /**
     * @return string
     *
     */

    public function saves()
    {
        return $this->first('goalie', 'saves');
    }

    /**
     * @return string
     *
     */

    public function goalsAllowed()
    {
        return $this->first('goalie', 'ga');
    }


}