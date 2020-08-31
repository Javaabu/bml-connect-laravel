<?php

namespace Javaabu\BmlConnect\Facades;

use Illuminate\Support\Facades\Facade;

class BmlConnectFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'bml-connect';
    }
}
