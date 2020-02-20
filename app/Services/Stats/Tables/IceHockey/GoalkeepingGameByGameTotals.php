<?php

namespace App\Services\Stats\Tables\IceHockey;


use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\CareerQueryTrait;
use App\Services\Stats\Traits\TotalsTrait;
use Illuminate\Database\Eloquent\Builder;


class GoalkeepingGameByGameTotals extends AbstractTable
{
    use CareerQueryTrait, TotalsTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     *
     */
    protected function build(): array
    {
        return [
            $this->minutes(),
            $this->ga(),
            $this->gaa(),
            $this->saves(),
            $this->wins(),
            $this->loses(),
            $this->ties(),
            $this->powerPlayGoals(),
            $this->shortHandedGoals(),
            $this->en()
        ];
    }

    /**
     * @return mixed|string
     *
     */
    private function minutes()
    {
        return $this->first('goalie', 'minutes')->raw_value ?? '--';
    }

    /**
     * Goals allowed.
     *
     * @return mixed
     *
     */
    private function ga()
    {
        return $this->sum('goalie', 'total_ga');
    }

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
        $result = '--';
        $goalsAgainst = $this->sum('goalie', 'total_ga', function ($value) {
            return intval($value);
        });
        $minutes = $this->all('goalie', 'minutes');

        $gameLength = $this->player->games()->whereHas('seasons', function (Builder $query) {
            $query->where('id', '=', $this->season->id);
        })->get()->sum('game_length');

        if (is_null($minutes) || !$minutes || is_null($gameLength) || !$goalsAgainst) {
            return $result;
        }

        //MM:SS
        if (!preg_match('/^([0-9]+){1,2}\:([0-9]+){1,2}$/', $minutes)) {
            return $result;
        }

        list($minutes, $seconds) = explode(':', $minutes);

        if (!$minutes) {
            return $result;
        }

        $minutes = intval($minutes);

        try {
            $result = number_format((($goalsAgainst * $gameLength) / $minutes), 2);
        } catch (\Exception $e) {
            \Log::alert(sprintf('Issue with the date in goalkeeping game by game: %s', $e->getMessage()));
        }

        return $result;
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
        return $this->getWinLossTie('win');
    }

    /**
     * Return loses.
     *
     * @return int|string
     */
    private function loses()
    {
        return $this->getWinLossTie('loss');
    }

    /**
     * Return ties.
     *
     * @return int|string
     */
    private function ties()
    {
        return $this->getWinLossTie('tie');
    }

    /**
     * @param string $type
     * @return int|string
     */
    private function getWinLossTie(string $type)
    {
        $data = $this->first('goalie', ['win', 'loss', 'tie'])->raw_value;

        if ($data && preg_match('/^\d+\-\d+\-\d+$/', $data)) {
            list($win, $loss, $tie) = explode('-', $data);

            switch ($type) {
                case 'win':
                    return number_format($win);
                    break;
                case 'loss':
                    return number_format($loss);
                    break;
                case 'tie':
                    return number_format($tie);
                    break;
            }
        }

        return 0;
    }

    /**
     * @return mixed
     */
    private function powerPlayGoals()
    {
        return $this->sum('goaltype', 'pp');
    }

    /**
     * @return mixed
     */
    private function shortHandedGoals()
    {
        return $this->sum('goaltype', 'sh');
    }

    /**
     * @return mixed
     */
    private function en()
    {
        return $this->sum('goaltype', 'en');
    }
}