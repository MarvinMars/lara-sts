<?php

namespace App\Services\Stats\Traits\Baseball;

trait  BaseballFieldingTrait
{
    /**
     * Putout: number of times the fielder tags, forces, or appeals a runner and he is called out as a result.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function putouts(bool $format = true)
    {
        return $this->sum('fielding', 'po', $format);
    }

    /**
     * Total chances: assists plus putouts plus errors.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function totalChances(bool $format = true)
    {
        $result = $this->assists(false) + $this->putouts(false) + $this->errors();

        return ($format ? number_format($result) : $result);
    }

    /**
     * Assists: number of outs recorded on a play where a fielder touched the ball, except if such touching is the putout.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function assists(bool $format = true)
    {
        return $this->sum('fielding', 'a', $format);
    }

    /**
     * Errors: number of times a fielder fails to make a play he should have made with common effort, and the offense benefits as a result.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function errors(bool $format = true)
    {
        return $this->sum('fielding', 'e', $format);
    }

    /**
     * Fielding percentage (FP): total plays (chances minus errors) divided by the number of total chances.
     *
     * @param bool $format
     *
     * @return float|int|string
     */
    private function fieldingPercentage(bool $format = true)
    {
        $totalChances = $this->totalChances(false);

        $result = ((float)$totalChances > 0 ? ($this->putouts(false) + $this->assists(false)) / $totalChances : 0);

        return $format ? number_format($result, 3) : $result;
    }

    /**
     * Catcher's Interference (e.g., catcher makes contact with bat).
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function catcherInterference(bool $format = true)
    {
        return $this->sum('fielding', 'ci', $format);
    }

    /**
     * Passed ball: charged to the catcher when the ball is dropped and one or more runners advance.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function passedBalls(bool $format = true)
    {
        return $this->sum('fielding', 'pb', $format);
    }

    /**
     * Stolen base attempts (ATT): total number of times the player has attempted to steal a base.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function stolenBaseAttempts(bool $format = true)
    {
        return $this->sum('fielding', 'sba', $format);
    }

    /**
     * Caught stealing (CS): times tagged out while attempting to steal a base.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function caughtStealing(bool $format = true)
    {
        return $this->sum('fielding', 'csb', $format);
    }

    /**
     * Triple play: one for each triple play during which the fielder recorded a putout or an assist.
     *
     * @param bool $format
     *
     * @return float|string
     */
    private function triplePlays(bool $format = true)
    {
        return $this->sum('fielding', 'tp', $format);
    }
}