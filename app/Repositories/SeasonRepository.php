<?php

namespace App\Repositories;

use App\Models\Season;

class SeasonRepository extends Repository
{
    public function __construct(Season $season)
    {
        parent::__construct($season);
    }
}
