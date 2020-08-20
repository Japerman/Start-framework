<?php

namespace Start\Providers;

use Start\Kernel\ServiceProvider;

class Auth extends ServiceProvider
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
        $this->app->singleton(\Start\Auth\Auth::class, \Start\Auth\Auth::class);

        if ($this->app->get('config')['auth']['jwt']['enabled'] === true) {
            $this->app->singleton('jwt', \Start\Auth\Jwt\Jwt::class);
        }
    }
}
