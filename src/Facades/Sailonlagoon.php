<?php

namespace Uselagoon\Sailonlagoon\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Uselagoon\Sailonlagoon\Sailonlagoon
 */
class Sailonlagoon extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Uselagoon\Sailonlagoon\Sailonlagoon::class;
    }
}
