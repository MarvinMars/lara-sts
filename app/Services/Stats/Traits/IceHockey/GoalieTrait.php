<?php

namespace App\Services\Stats\Traits\IceHockey;

/**
 * Trait GoalieTrait
 * @package App\Services\Stats\Traits
 */
trait GoalieTrait
{
    /**
     * Goals against average.
     *
     * https://captaincalculator.com/sports/goals-against-average-calculator/
     * Goals Against Average = (goals against x game length) / minutes played.
     *
     * @return int|string
     *
     */
    private function gaa()
    {
        $result = 0;

        $goalsAgainst = $this->sum('goalie', 'total_ga', false);
        $seconds = $this->seconds();

        try {
            $result = $seconds > 0 ? ((3600 * $goalsAgainst) / $seconds) : 0;
        } catch (\Exception $e) {
            \Log::alert(sprintf('Issue with the date in goalkeeping game by game: %s', $e->getMessage()));
        }

        return number_format($result, 3);
    }


    /**
     * Get game duration in format.
     *
     * @return string
     */
    private function gameDuration()
    {
        return gmdate('H:i:s', $this->gameLengthSeconds());
    }

    /**
     * Get goalie minutes
     *
     * @return string
     */
    private function minutes()
    {
        $sumSeconds = $this->seconds();
        $minutes = floor($sumSeconds / 60);
        $seconds = intval($sumSeconds % 60);

        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    /**
     * Get goalie seconds.
     *
     * @return integer
     */
    private function seconds()
    {
        return $this->all('goalie', 'minutes')
            ->pluck('raw_value')
            ->filter(function ($minutes) {
                return preg_match('/^([0-9]+){1,2}\:([0-9]+){1,2}$/', $minutes);
            })
            ->map(function ($minutes) {
                list($minutes, $seconds) = explode(':', $minutes);

                return ($minutes * 60) + $seconds;
            })->sum();
    }

    /**
     * Return game length in seconds.
     *
     * @return int
     */
    private function gameLengthSeconds()
    {
        $seconds = 0;

        if (!is_null($this->game)) {
            $seconds += $this->game->game_length_seconds;
        } elseif (!is_null($this->season)) {
            foreach ($this->player->gamesBySeason($this->season) as $game) {
                $seconds += $game->game_length_seconds;
            }
        }

        return intval($seconds);
    }

    /**
     * Goals allowed.
     *
     * @return mixed
     *
     */
    private function goalsAllowed()
    {
        return $this->sum('goalie', 'total_ga');
    }

    /**
     * Saves.
     *
     * @return int
     *
     */
    private function saves()
    {
        return $this->sum('goalie', 'saves');
    }

    /**
     * Return wins.
     *
     * @return int|string
     */
    private function wins()
    {
        return $this->count('goalie', 'win');
    }

    /**
     * Return loses.
     *
     * @return int|string
     */
    private function loses()
    {
        return $this->count('goalie', 'loss');
    }

    /**
     * Return ties.
     *
     * @return int|string
     */
    private function ties()
    {
        return $this->count('goalie', 'tie');
    }

    /**
     * Powerplay goals.
     *
     * @param bool $format
     *
     * @return string|float
     */
    private function powerPlayGoals(bool $format = true)
    {
        return $this->sum('goalie', 'ppg', $format);
    }

    /**
     * Shorthanded goals: humber of goals the player has scored while his team was shorthanded.
     *
     * @param bool $format
     *
     * @return string|float
     */
    private function shortHandedGoals(bool $format = true)
    {
        return $this->sum('goalie', 'shg', $format);
    }

    /**
     * Empty net goals: number of goals scored on an empty net.
     *
     * @param bool $format
     *
     * @return string|float
     */
    private function emptyNetGoals(bool $format = true)
    {
        return $this->sum('goalie', 'eng', $format);
    }
}