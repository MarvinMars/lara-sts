<?php

namespace App\Facades;
use App\Services\Stats\Sport\Lacrosse;
use Illuminate\Support\Facades\Facade;

class LacrosseFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Lacrosse::class;
    }
}