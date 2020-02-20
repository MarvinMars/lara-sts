<?php

namespace App\Services\Stats\Tables\Soccer;

use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;

/**
 * Class Career
 * @package App\Classes\Stats\Sports
 */
class CareerScoringStats extends AbstractTable
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
            $this->gp(),                            /* gp */
            $this->gs(),
            $this->goals(),                                  /* g */
            $this->assists(),                                /* a */
            $this->points(),                                 /* pts */
            $this->shots(),                                  /* sh */
            $this->shotsPercent(),                        /* shPercent */
            $this->shotsOnGoal(),                            /* sog */
            $this->shotsOnGoalPercent(),                  /* sogPercent */
            $this->gw(),
            $this->pkAtt(),
            $this->minutes(),                                /* min */
        ];

        return $result;
    }

    /**
     * @param bool $format
     *
     * @return string
     */

    public function goals(bool $format = true)
    {
        return $this->sum('shots', 'g', $format);
    }

    /**
     * @return string
     *
     */

    public function assists()
    {
        return $this->sum('shots', 'a');
    }

    /**
     * @param bool $format
     *
     * @return string
     *
     */

    public function minutes(bool $format = true)
    {
        return $this->sum('misc', 'minutes', $format);
    }

    /**
     * @return string
     *
     */
    public function goalApp()
    {
        return $this->sum('goalie', 'ga');
    }

    /**
     * @return string
     *
     */
    public function gaAvg()
    {
        $min = $this->minutes();
        $ga = $this->goalApp();

        return number_format(( (float)$min > 0 ? (($ga * 90) / $min) : 0), 3);
    }

    /**
     * @return string
     *
     */
    public function saves()
    {
        return $this->sum('goalie', 'saves');
    }

    /**
     * @return string
     *
     */
    public function shutout()
    {
        return $this->sum('goalie', 'shutout');
    }

    /**
     * @return string
     *
     */
    public function sf()
    {
        return $this->sum('goalie', 'sf');
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
    public function gs()
    {
        return $this->sum('player', 'gs');
    }

    /**
     * @return string
     *
     */
    public function points()
    {
        return $this->sum('shots', 'ps');
    }

    /**
     * @return string
     *
     */
    public function shots()
    {
        return $this->sum('shots', 'sh');
    }

    /**
     * @return string
     *
     */
    public function shotsPercent()
    {
        $g = $this->goals();
        $sh = $this->shots();

        $result = ( (float)$sh > 0) ? ($g / $sh) : 0;

        return number_format($result, 3);
    }

    /**
     * @return string
     *
     */
    public function shotsOnGoalPercent()
    {
        $g = $this->goals(false);
        $sog = $this->shotsOnGoal(false);

        $result = ($sog && (float)$sog && $g) ? ($g / $sog) : 0;

        return number_format($result, 3);
    }

    /**
     * @return string
     *
     */
    public function gw()
    {
        return $this->sum('goaltype', 'gw');
    }

    /**
     * @return string
     *
     */
    public function pkAtt()
    {
        return $this->sum('shots', 'psatt');
    }
}
