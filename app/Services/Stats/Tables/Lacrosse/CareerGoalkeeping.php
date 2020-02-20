<?php

namespace App\Services\Stats\Tables\Lacrosse;

use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;

/**
 * Class Career
 * @package App\Classes\Stats\Sports
 */
class CareerGoalkeeping extends AbstractTable
{
    use CareerQueryTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     *
     */
    protected function build(): array
    {
        $result = [
            $this->gp(),              /* gp */
            $this->minutes(),                  /* min */
            $this->goalsAllowed(),             /* ga */
            $this->goalsAllowedAvg(),          /* gaAvg */
            $this->saves(),                    /* sv */
            $this->savesPercent(),              /* svPercent */
            $this->shutouts(),                  /* sho */
            $this->shotsFaced(),                /* sf */
        ];

        return $result;
    }

    /**
     * @param bool $format
     *
     * @return string
     */

    public function minutes(bool $format = true)
    {
        return $this->sum('misc', 'minutes', $format);
    }

    /**
     * @param bool $format
     *
     * @return string
     */
    public function goalsAllowed(bool $format = true)
    {
        return $this->sum('goalie', 'ga', $format);
    }

    /**
     * @return string
     *
     */
    public function goalsAllowedAvg()
    {
        $min = $this->minutes(false);
        $ga = $this->goalsAllowed(false);

        $result = ( (float)$min > 0 ? (($ga * 90) / $min) : 0);

        return number_format($result);
    }

    /**
     * @param bool $format
     *
     * @return string
     */
    public function saves(bool $format = true)
    {
        return $this->sum('goalie', 'saves', $format);
    }

    /**
     * @param bool $format
     *
     * @return string
     */
    public function shotsOnGoal(bool $format = true)
    {
        return $this->sum('shots', 'sog', $format);
    }

    /**
     * @return string
     *
     */
    public function savesPercent()
    {
        $sog = $this->shotsOnGoal(false);
        $sv = $this->saves(false);

        $result = (float)$sog > 0 ? $sv / $sog : 0;

        return number_format($result, 3);
    }

    /**
     * @return string
     *
     */
    public function shutouts()
    {
        return $this->sum('goalie', 'shutout');
    }

    /**
     * @return string
     *
     */
    public function shotsFaced()
    {
        return $this->sum('goalie', 'sf');
    }
}
