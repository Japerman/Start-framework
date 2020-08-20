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
        $this->app->singleton(\Start\Http\Request::class, \Start\Http\Request::class);
    }
}
