<?php

namespace App\Services\Stats\Traits;

use App\Models\PlayerValue;
use Illuminate\Database\Eloquent\Builder;

trait GameByGameQueryTrait
{
    /**
     * Query must return prepared builder for the next queries.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function query(): Builder
    {
        $query = PlayerValue::wherePlayerId($this->player->id)
            ->whereHas('game', function (Builder $query) {
                if ($this->game) {
                    $query->where('id', '=', $this->game->id);
                }
                $query->whereHas('seasons', function (Builder $query) {
                    $query->where('id', '=', $this->season->id);
                });
            });

        if ($this->game) {
            $query->whereGameId($this->game->id);
        }

        return $query;
    }


    /**
     * Return query which return all games which happens before the current game.
     *
     * @return \Illuminate\Database\Query\Builder|static
     * @throws \App\Services\Stats\Exceptions\QueryMethodDoesNotDefinedException
     */
    public final function withPastGames()
    {
        return (clone $this)->setQueryMethod('pastGamesQuery');
    }

    /**
     * Return query with all past games include the current game.
     *
     * @return Builder|static
     */
    protected final function pastGamesQuery()
    {
        return PlayerValue::wherePlayerId($this->player->id)
            ->whereHas('game', function (Builder $query) {
                if ($this->game) {
                    $query->whereDate('date', '<', $this->game->date);
                }

                $query->whereHas('seasons', function (Builder $query) {
                    $query->where('id', '=', $this->season->id);
                });
            });
    }
}