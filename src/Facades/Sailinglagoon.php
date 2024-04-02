<?php

namespace Uselagoon\Sailinglagoon\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Uselagoon\Sailinglagoon\Sailinglagoon
 */
class Sailinglagoon extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Uselagoon\Sailinglagoon\Sailinglagoon::class;
    }
}
