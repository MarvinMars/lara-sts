<?php

namespace App\Services\Stats\Tables\Lacrosse;

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
            $this->gp(),                                    /* gp */
            $this->gs(),
            $this->goals(),                                  /* g */
            $this->assists(),                                /* a */
            $this->points(),                                 /* pts */
            $this->shots(),                                  /* sh */
            $this->shotsPercent(),                          /* shPercent */
            $this->shotsOnGoal(),                           /* sog */
            $this->shotsOnGoalPercent(),                  /* sogPercent */
            $this->gw(),
//            $this->pkAtt(),
            $this->minutes(),                                /* min */
//            $this->up(),
//            $this->dn(),
//            $this->to(),
            $this->groundBalls(),
            $this->ct(),
//            $this->fo(),
//            $this->foPercent(),
        ];

        return $result;
    }

    public function gb(bool $format = true)
    {
        return $this->sum('shots', 'g', $format);
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
        $points = (int)$this->goals() + (int)$this->assists();
        return  $points ;
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

        $result = (float)$sh ? ($g / $sh) : 0;

        return number_format($result, 3);
    }

    /**
     * @return string
     *
     */
    public function shotsOnGoalPercent()
    {
        $sh = $this->shots();
        $sog = $this->shotsOnGoal(false);

        $result = (( (float)$sh > 0 && $sog) ? ($sog / $sh) : 0);

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

//    /**
//     * @return string
//     *
//     */
//    public function pkAtt()
//    {
//        return $this->sum('shots', 'psatt');
//    }


//    public function up(bool $format = true)
//    {
//        return $this->sum('shots', 'g', $format);
//    }
//
//    public function dn(bool $format = true)
//    {
//        return $this->sum('shots', 'g', $format);
//    }
//    /**
//     * @param bool $format
//     * @return float|int|string
//     */
//    public function to(bool $format = true)
//    {
//        return $this->sum('shots', 'g', $format);
//    }

    /**
     * @param bool $format
     * @return float|int|string
     */
    public function groundBalls(bool $format = true)
    {
        return $this->sum('misc', 'gb', $format);
    }

    /**
     * @param bool $format
     * @return float|int|string
     */
    public function ct(bool $format = true)
    {
        return $this->sum('misc', 'ct', $format);
    }

    /**
     * @param bool $format
     * @return float|int|string
     */
    public function facewon(bool $format = true)
    {
        return $this->sum('misc', 'facewon', $format);
    }

    /**
     * @param bool $format
     * @return float|int|string
     */
    public function facelost(bool $format = true)
    {
        return $this->sum('misc', 'facelost', $format);
    }

    /**
     * @return string
     */
    public function fo()
    {
        $facewon = $this->facewon();
        $facelost = $this->facewon();
        $fo = $facewon ? $facewon : 0 .'-'.  $facelost ? $facelost : 0;
        unset($facewon,$facelost);

        return $fo;
    }

    /**
     * @return string
     */
    public function foPercent()
    {
        $facewon = $this->facewon();
        $g = $this->goals();

        $result = (( (float)$facewon > 0) ? ($g / $facewon) : 0);

        return number_format($result, 3);
    }

}
