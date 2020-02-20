<?php

namespace App\Services\Stats\Traits\Baseball;

use App\Models\PlayerValue;
use Illuminate\Database\Eloquent\Builder;

trait BaseballPitchingTrait
{

    /**
     * http://redmine.webmetech.com/projects//wiki/Pitching_Statistics#IP
     *
     * @param bool $format
     *
     * @return float
     */
    private function inningsPitched(bool $format = true)
    {
        $inningPitched = $this->all('pitching', 'ip')
            ->pluck('value')
            ->map(function ($value) {
                $valueFloor = round(floor($value), 0);
                $valueFraction = round(fmod($value, 1), 1);

                return round($valueFloor + (($valueFraction * 10) / 3), 3);
            })->sum();

        if ($format === true) {
            $valueFloor = round(floor($inningPitched), 0);
            $valueFraction = round(fmod($inningPitched, 1), 3);

            $result = $valueFloor;

            $valueFractionResult = round(($valueFraction * 3) / 10, 1);

            if ($valueFractionResult > 0 && $valueFractionResult < 0.3) {
                $result += $valueFractionResult;
            } elseif ($valueFractionResult > 0 && $valueFractionResult == 0.3) {
                $result++;
            }

            return number_format($result, 1);
        }

        return $inningPitched;
    }

    //ERA = 9 × Earned Runs Allowed / Innings Pitched
    private function era()
    {
        $result = 0;
        $er = $this->earnedRuns(false);
        $ip = $this->inningsPitched(false);

        if ((float)$ip > 0) {
            $result = ((9 * $er) / $ip);
        }

        return number_format($result, 2);
    }

    private function winLoss()
    {
        if (!$this->season) {
            return '--';
        }

        return number_format($this->winOrLoss('win')) . '-' . number_format($this->winOrLoss('loss'));
    }

    /**
     * Get the win record based on values.
     *
     * @param string $key
     *
     * @return float
     */
    private function winOrLoss(string $key = 'win')
    {
        $result = 0;
        /** @var PlayerValue $playerValue */
        $playerValue = PlayerValue::select(['raw_value'])
            ->leftJoin('games', 'games.id', '=', 'player_values.game_id')
            ->whereHas('game', function (Builder $query) {
                $query->whereHas('seasons', function (Builder $query) {
                    $query->where('id', '=', $this->season->id);
                });
            })
            ->where('player_id', '=', $this->player->id)
            ->where('group', '=', 'pitching')
            ->whereIn('key', ['win', 'loss'])
            ->orderByDesc('games.date')
            ->first();

        if ($playerValue) {
            $value = $playerValue->raw_value;

            $values = explode('-', $value);

            if (is_array($values)) {
                switch ($key) {
                    case 'win':
                        $result = array_first($values);
                        break;
                    case 'loss':
                        $result = array_last($values);
                        break;
                }
            }
        }

        return (float)$result;

    }

    private function app_gs()
    {
        return $this->appear() . '-' . $this->gameStarted();
    }

    private function appear()
    {
        return $this->sum('pitching', 'appear');
    }

    private function g()
    {
        return $this->sum('pitching', 'g');
    }

    private function gameStarted()
    {
        return $this->sum('pitching', 'gs');
    }

    private function hits(bool $format = true)
    {
        return $this->sum('pitching', 'h', $format);
    }

    private function runs()
    {
        return $this->sum('pitching', 'r');
    }

    private function earnedRuns(bool $format = true)
    {
        return $this->sum('pitching', 'er', $format);
    }

    private function baseOnBalls()
    {
        return $this->sum('pitching', 'bb');
    }

    private function strikeOut()
    {
        return $this->sum('pitching', 'so');
    }

    private function homeRuns()
    {
        return $this->sum('pitching', 'hr');
    }

    private function atBats(bool $format = true)
    {
        return $this->sum('pitching', 'ab', $format);
    }

    //Batting Average = Total number of hits / Total number of at bats
    private function battingAverage()
    {
        $hits = $this->hits(false);
        $atBats = $this->atBats(false);

        return ((float)$atBats > 0) ? number_format(($hits / $atBats), 3) : 0.000;
    }

    private function wildPitch()
    {
        return $this->sum('pitching', 'wp');
    }

    private function balk()
    {
        return $this->sum('pitching', 'bk');
    }

    private function sacrificeFlyAllowed()
    {
        return $this->sum('pitching', 'sfa');
    }

    private function hitsByPitch()
    {
        return $this->sum('pitching', 'hbp');
    }

    private function battersFaced()
    {
        return $this->sum('pitching', 'bf');
    }

    /**
     * Double.
     *
     * @return mixed
     */
    private function double()
    {
        return $this->sum('pitching', 'double');
    }

    /**
     * Triple.
     *
     * @return mixed
     */
    private function triple()
    {
        return $this->sum('pitching', 'triple');
    }

    private function fly()
    {
        return $this->sum('psitsummary', 'fly');
    }

    /**
     * Ground.
     *
     * @return mixed
     */
    private function ground()
    {
        return $this->sum('psitsummary', 'ground');
    }

    private function npStk()
    {
        $pitches = $this->sum('psitsummary', 'pitches');
        $strikes = $this->sum('psitsummary', 'strikes');

        return $pitches . '/' . $strikes;
    }

    private function completeGame()
    {
        return $this->sum('pitching', 'cg');
    }

    private function shotouts()
    {
        return $this->sum('pitching', 'sho');
    }
}
