<?php

namespace App\Facades;

use App\Services\Stats\Sport\Softball;
use Illuminate\Support\Facades\Facade;

class SoftballFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return Softball::class;
    }
}
