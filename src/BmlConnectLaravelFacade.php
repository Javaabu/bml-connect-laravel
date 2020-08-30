<?php

namespace Javaabu\BmlConnectLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Javaabu\BmlConnectLaravel\Skeleton\SkeletonClass
 */
class BmlConnectLaravelFacade extends Facade
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
