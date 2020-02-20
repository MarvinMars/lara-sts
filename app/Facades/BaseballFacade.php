<?php

namespace App\Facades;

use App\Services\Stats\Sport\Baseball;
use Illuminate\Support\Facades\Facade;

class BaseballFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Baseball::class;
    }
}
