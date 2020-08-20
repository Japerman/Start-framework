<?php

namespace Start\Providers;

use Start\Kernel\ServiceProvider;

class Response extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     * @throws
     */
    public function register()
    {
        $this->app->singleton(\Start\Http\Response::class, \Start\Http\Response::class);
    }
}
