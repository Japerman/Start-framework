<?php

namespace Start\Facades;

use Start\Kernel\Facade;

class Uri extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'uri';
    }
}