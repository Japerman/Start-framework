<?php

namespace Start\Providers;

use Start\Kernel\ServiceProvider;

class Route extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     * @throws
     */
    public function register()
    {
        $this->app->singleton('route', \Start\Router\Route::class);
    }
}
