<?php

namespace Start\Providers;

use Start\Kernel\ServiceProvider;

class Cookie extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     * @throws
     */
    public function register()
    {
        $this->app->singleton('cookie', \Nur\Http\Cookie::class);
    }
}
