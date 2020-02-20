<?php

namespace App\Repositories;

use App\Models\Sport;

class SportRepository extends Repository
{
    public function __construct(Sport $season)
    {
        parent::__construct($season);
    }
}
