<?php

namespace App\Services\Stats\Tables\Lacrosse;

use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\HighsQueryTrait;

class Highs extends AbstractTable
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
            'shots',                        /* SH */
            'shotsOnGoal',                  /* SOG */
            'goals',                        /* G */
            'assists',                      /* A */
            'minutes',                      /* MIN */
            'groundBalls',                   /* GB (MISC) */
            'causedTurnovers'               /* CT */
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

    public function shots()
    {
        return $this->first('shots', 'sh');
    }

    /**
     * @return string
     *
     */

    public function shotsOnGoal()
    {
        return $this->first('shots', 'sog');
    }

    /**
     * @return string
     *
     */

    public function goals()
    {
        return $this->first('shots', 'g');
    }

    /**
     * @return string
     *
     */

    public function assists()
    {
        return $this->first('shots', 'a');
    }

    /**
     * @return string
     *
     */

    public function minutes()
    {
        return $this->first('misc', 'minutes');
    }

    /**
     * @return string
     *
     */
    public function groundBalls()
    {
        return $this->first('misc', 'gb');
    }

    /**
     * @return string
     *
     */
    public function causedTurnovers()
    {
        return $this->first('misc', 'ct');
    }
}