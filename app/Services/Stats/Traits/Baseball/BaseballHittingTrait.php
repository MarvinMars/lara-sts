<?php

namespace App\Services\Stats\Traits\Baseball;

trait BaseballHittingTrait
{
    /**
     * Batting average (also abbreviated AVG): hits divided by at bats.
     * @formula H/AB
     *
     * @return string
     */
    private function battingAverage()
    {
        $hits = $this->hits(false);
        $atBats = $this->atBats(false);

        $result = ((float)$atBats > 0 ? $hits / $atBats : 0);

        return number_format($result, 3);
    }

    /**
     * Refers to how frequently a batter reaches base per plate appearance.
     * @formula (H + BB + HBP)/(AB + BB + HBP + SF)
     *
     * @return string
     */
    private function OBPct()
    {
        $left = $this->sum('hitting', ['h', 'bb', 'hbp'], false);
        $right = $this->sum('hitting', ['ab', 'bb', 'hbp', 'sf'], false);

        $result = ((float)$right > 0 ? $left / $right : 0);

        return number_format($result, 3);
    }


    /**
     * Slugging average: total bases achieved on hits divided by at-bats
     * @formula TB/AB
     *
     * @return string
     */
    private function sluggingAverage()
    {
        $totalBases = $this->totalBases(false);
        $atBats = $this->atBats(false);

        $result = ((float)$atBats > 0 ? $totalBases / $atBats : 0);

        return number_format($result, 3);
    }

    /**
     * Runs scored: number of times a player crosses home plate.
     *
     * @param bool $format
     *
     * @return mixed
     */
    private function runsScored(bool $format = true)
    {
        return $this->sum('hitting', 'r', $format);
    }

    /**
     * At bat: Plate appearances, not including bases on balls, being hit by pitch, sacrifices, interference, or obstruction
     *
     * @param bool $format
     *
     * @return string|float
     */
    private function atBats(bool $format = true)
    {
        return $this->sum('hitting', 'ab', $format);
    }

    /**
     * Hits: times reached base because of a batted, fair ball without error by the defense.
     *
     * @param bool $format
     *
     * @return mixed
     */
    private function hits(bool $format = true)
    {
        return $this->sum('hitting', 'h', $format);
    }

    /**
     * Double: hits on which the batter reaches second base safely without the contribution of a fielding error.
     *
     * @param bool $format
     *
     * @return mixed
     */
    private function double(bool $format = true)
    {
        return $this->sum('hitting', 'double', $format);
    }

    /**
     * Triple: hits on which the batter reaches third base safely without the contribution of a fielding error.
     *
     * @param bool $format
     *
     * @return mixed
     */
    private function triple(bool $format = true)
    {
        return $this->sum('hitting', 'triple', $format);
    }

    /**
     * Total bases: one for each single, two for each double, three for each triple, and four for each home run.
     * @formula H + 2B + (2 × 3B) + (3 × HR) or 1B + (2 × 2B) + (3 × 3B) + (4 × HR)
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function totalBases(bool $format = true)
    {
        $result = $this->hits(false) + $this->double(false) + (2 * $this->triple(false)) + (3 * $this->homeRuns(false));

        return ($format ? number_format($result) : $result);
    }

    /**
     * Home runs: hits on which the batter successfully touched all four bases, without the contribution of a fielding error.
     *
     * @param bool $format
     *
     * @return string|float
     */
    private function homeRuns(bool $format = true)
    {
        return $this->sum('hitting', 'hr', $format);
    }

    /**
     * Run batted in: number of runners who score due to a batters' action, except when batter grounded into double play or reached on an error
     *
     * @param bool $format
     *
     * @return string|float
     */
    private function runBattedIn(bool $format = true)
    {
        return $this->sum('hitting', 'rbi', $format);
    }

    /**
     * Base on balls (also called a "walk"): hitter not swinging at four pitches called out of the strike zone and awarded first base.
     *
     * @param bool $format
     *
     * @return string|float
     */
    private function baseOnBalls(bool $format = true)
    {
        return $this->sum('hitting', 'bb', $format);
    }

    /**
     * Hit by pitch: times touched by a pitch and awarded first base as a result.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function hitsByPitch(bool $format = true)
    {
        return $this->sum('hitting', 'hbp', $format);
    }

    /**
     * Sacrifice fly: Fly balls hit to the outfield which although caught for an out, allow a baserunner to advance.
     *
     * @return float|string
     */
    private function sacrificeFly()
    {
        return $this->sum('hitting', 'sf');
    }

    /**
     * Sacrifice hit: number of sacrifice bunts which allow runners to advance on the basepaths.
     */
    private function sacrificeHit()
    {
        return $this->sum('hitting', 'sh');
    }

    /**
     * Strike out (also abbreviated SO): number of times that a third strike is taken or swung at and missed, or
     * bunted foul. Catcher must catch the third strike or batter may attempt to run to first base.
     *
     * @return mixed
     */
    private function strikeOut()
    {
        return $this->sum('hitting', 'so');
    }

    /**
     * Caught stealing: times tagged out while attempting to steal a base.
     *
     * @return float|string
     */
    private function caughtStealing()
    {
        return $this->sum('hitting', 'cs');
    }

    /**
     * Stolen base: number of bases advanced by the runner while the ball is in the possession of the defense.
     *
     * @return float|string
     */
    private function stolenBase()
    {
        return $this->sum('hitting', 'sb');
    }
}