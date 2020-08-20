<?php

namespace Start\Providers;

use Start\Kernel\ServiceProvider;

class Load extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     * @throws
     */
    public function register()
    {
        $this->app->singleton('load', \Start\Load\Load::class);
    }
}
