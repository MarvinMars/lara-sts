<?php

namespace App\Repositories;

use App\Models\Game;

class GameRepository extends Repository
{
    public function __construct(Game $model)
    {
        parent::__construct($model);
    }
}
