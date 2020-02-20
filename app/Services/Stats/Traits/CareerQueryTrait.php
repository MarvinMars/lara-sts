<?php

namespace App\Services\Stats\Traits;

use App\Models\PlayerValue;
use Illuminate\Database\Eloquent\Builder;

trait CareerQueryTrait
{
    /**
     * Query must return prepared builder for the next queries.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function query(): Builder
    {
        return PlayerValue::wherePlayerId($this->player->id)
            ->whereHas('game', function (Builder $query) {
                if ($this->season) {
                    $query->whereHas('seasons', function (Builder $query) {
                        $query->where('id', '=', $this->season->id);
                    });
                }
            });
    }
}