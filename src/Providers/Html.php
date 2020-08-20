<?php

namespace Start\Providers;

use Start\Kernel\ServiceProvider;

class Html extends ServiceProvider
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
        $this->app->singleton('html', \Start\Components\Builder\Html::class);
        $this->app->singleton('form', \Start\Components\Builder\Form::class);
    }
}
