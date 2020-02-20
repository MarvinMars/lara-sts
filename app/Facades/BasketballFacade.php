<?php

namespace App\Facades;
use App\Services\Stats\Sport\Basketball;
use Illuminate\Support\Facades\Facade;

class BasketballFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Basketball::class;
    }
}