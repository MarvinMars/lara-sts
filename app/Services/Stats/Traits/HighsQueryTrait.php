<?php

namespace App\Services\Stats\Traits;

use App\Models\Game;
use App\Models\PlayerValue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Trait HighsQueryTrait
 * @package App\Services\Stats\Traits
 *
 * @property \App\Models\Player $player
 */
trait HighsQueryTrait
{
    /**
     * Query must return prepared builder for the next queries.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function query(): Builder
    {
        return PlayerValue::select(
            [
                \DB::raw('MAX(value) as aggregate'),
                'game_id',
                'player_id',
            ])
            ->wherePlayerId($this->player->id)
            ->whereHas('game', function (Builder $query) {
                $query->whereHas('seasons', function (Builder $query) {
                    $query->where('id', '=', $this->season->id);
                });
            })
            ->groupBy(['game_id', 'player_id'])
            ->with('game', 'player')
            ->orderByDesc('aggregate')
            ->orderByDesc('game_id')
            ->limit(1);
    }


    /**
     * Clone original query and return it.
     *
     * @param string $group
     * @param array $keys
     *
     * @return Builder|\Illuminate\Database\Query\Builder
     */
    public function getQuery(string $group, array $keys)
    {
        /** @var Builder $query */
        $query = call_user_func([$this, $this->query_method]);

        if (count($keys) > 1) {
            $originalQuery = clone $query;
            $originalQuery->select([
                \DB::raw('SUM(value) as aggregate'),
                'game_id',
                'player_id',
            ])
                ->groupBy(['game_id', 'player_id', 'group'])
                ->where('group', '=', $group)
                ->whereIn('key', $keys);


            return \DB::table(\DB::raw(sprintf('(%s) as sub', $originalQuery->toSql())))
                ->mergeBindings($originalQuery->getQuery())
                ->select(
                    [
                        \DB::raw('MAX(sub.aggregate) as aggregate'),
                        'game_id',
                        'player_id',
                    ])
                ->groupBy(['game_id', 'player_id'])
                ->orderByDesc('aggregate')
                ->orderByDesc('game_id')
                ->limit(1);
        }

        return parent::getQuery($group, $keys);
    }

    /**
     * Must return array of the items which will show in the table.
     *
     * @return mixed
     */
    protected function build(): array
    {
        $data = $this->highsData();

        $result = [];

        foreach ($data as $item) {
            $highValue = $this->get($item);

            if (null !== $highValue) {
                $result[] = $highValue;
            }
        }

        return $result;
    }


    /**
     * Helper to get the array for the value.
     *
     * @param $key
     *
     * @return null|Collection
     */
    protected function get(string $key): ?Collection
    {
        if (method_exists($this, $key)) {
            $result = [
                'title' => trans('highs.' . $key),
                'value' => '--',
                'date' => '--',
                'opponent' => '--',
            ];

            $playerValue = $this->$key();

            if ($playerValue && isset($playerValue->game_id)) {
                $game = Game::find($playerValue->game_id);

                $value = optional($playerValue)->aggregate;

                if (!is_numeric($value)) {
                    $value = 0;
                }

                $result['value'] = number_format($value);
                $result['date'] = $game ? $game->game_date : '--';
                $result['opponent'] = $game ? $game->opponent_name : '--';
            }

            return collect($result);
        }

        return null;
    }
}
