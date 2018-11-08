<?php

namespace Onicial\LaravelBulmaNotifications\Facades;

use Illuminate\Support\Facades\Facade;

class Notifications extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'notify';
    }
}
