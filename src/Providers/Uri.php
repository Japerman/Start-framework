<?php

namespace Start\Providers;

use Start\Kernel\ServiceProvider;

class Uri extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     * @throws
     */
    public function register()
    {
        $this->app->singleton('uri', \Start\Uri\Uri::class);
    }
}
