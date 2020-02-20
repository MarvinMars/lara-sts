<?php

namespace App\Classes\Stats\Sports\Highs;

use App\Classes\Stats\Sports\Traits\CloneQuery;
use App\Models\PlayerValue;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractHighs
{
    use CloneQuery;

    /**
     * @var Builder
     */
    protected $query;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $results;

    /**
     * AbstractFootballGame constructor.
     *
     * @param Builder $query
     */
    public function __construct(Builder $query)
    {
        $this->query = $query;
        $this->results = collect();
    }

    public function get($key)
    {
        $result = [
            'title' => trans('highs.' . $key),
            'value' => '--',
            'date' => '--',
            'opponent' => '--',
        ];
        if (method_exists($this, $key)) {
            /** @var PlayerValue $playerValue */
            $playerValue = $this->$key()->first();
            $opponent = $gameDate = '--';
            if (isset($playerValue->player, $playerValue->game)) {
                $opponent = $playerValue->player->getOpponentNameByGame($playerValue->game);
                $gameDate = $playerValue->game->game_date;
            }
            $value = $playerValue->aggregate ?? 0;

            $result['value'] = number_format($value);
            $result['date'] = $gameDate;
            $result['opponent'] = $opponent;

            return collect($result);
        }

        return null;
    }

    public function _getQuery(...$args)
    {
        $query = clone $this->query;

        if (is_array($args) && sizeof($args) === 2) {
            $query->where('group', '=', $args[0])->where('key', '=', $args[1]);
        }

        return $query;
    }
}
