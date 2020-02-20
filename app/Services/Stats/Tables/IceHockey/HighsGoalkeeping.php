<?php

namespace App\Services\Stats\Tables\IceHockey;


use App\Models\PlayerValue;
use App\Services\Stats\Tables\AbstractTable;
use App\Services\Stats\Traits\HighsQueryTrait;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Highs
 * @package App\Services\Stats\Tables\IceHockey
 */
class HighsGoalkeeping extends AbstractTable
{
    use HighsQueryTrait;

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     */
    protected function build(): array
    {
        $data = [
            'saves',
            'goalsAllowed',
            'minutes',
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
     * Return saves for the goalkeeping.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     *
     */
    protected function saves()
    {
        return $this->first('goalie', 'saves');
    }

    /**
     * Return goals allowed for the foalkeeping.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     *
     */
    protected function goalsAllowed()
    {
        return $this->first('goalie', 'total_ga');
    }

    /**
     * Return minutes for the goalkeeping.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|null|object
     *
     */
    protected function minutes()
    {
        $maxValue = PlayerValue::wherePlayerId($this->player->id)
            ->whereHas('game', function (Builder $query) {
                if ($this->game) {
                    $query->where('id', '=', $this->game->id);
                }
                $query->whereHas('seasons', function (Builder $query) {
                    $query->where('id', '=', $this->season->id);
                });
            })->where('group', '=', 'goalie')
            ->where('key', '=', 'minutes')
            ->get()
            ->filter(function (PlayerValue $value) {
                return preg_match('/^([0-9]+){1,2}\:([0-9]+){1,2}$/', $value->raw_value);
            })
            ->map(function (PlayerValue $value) {
                list($minutes, $seconds) = explode(':', $value->raw_value);

                $value->value = ($minutes * 60) + $seconds;

                return $value;
            })->sortByDesc('value')
            ->first();

        if ($maxValue && isset($maxValue->value)) {
            $sumSeconds = $maxValue->value;
            $minutes = floor($sumSeconds / 60);
            $seconds = intval($sumSeconds % 60);

            $maxValue->aggregate = sprintf('%02d:%02d', $minutes, $seconds);
        }

        return $maxValue;
    }
}