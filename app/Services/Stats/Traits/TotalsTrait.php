<?php

namespace App\Services\Stats\Traits;

use App\Models\Game;
use Illuminate\Database\Eloquent\Builder;

trait TotalsTrait
{

    protected function seasonGames(): Builder
    {
        return Game::whereHas('seasons', function (Builder $query) {
            $query->where('id', '=', $this->season->id);
        });
    }
}