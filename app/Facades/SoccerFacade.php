<?php

namespace App\Facades;
use App\Services\Stats\Sport\Soccer;
use Illuminate\Support\Facades\Facade;

class SoccerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Soccer::class;
    }
}