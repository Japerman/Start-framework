<?php

namespace Start\Providers;

use Start\Kernel\ServiceProvider;

class Request extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     * @throws
     */
    public function register()
    {
        $this->app->singleton(\Nur\Http\Request::class, \Nur\Http\Request::class);
    }
}
