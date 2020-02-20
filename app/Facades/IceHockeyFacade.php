<?php

namespace App\Facades;

use App\Services\Stats\Sport\IceHockey;
use Illuminate\Support\Facades\Facade;

class IceHockeyFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return IceHockey::class;
    }
}
