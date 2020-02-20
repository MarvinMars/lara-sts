<?php

namespace App\Facades;

use App\Services\Stats\Sport\Baseball;
use App\Services\Stats\Sport\Football;
use Illuminate\Support\Facades\Facade;

class FootballFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Football::class;
    }
}
