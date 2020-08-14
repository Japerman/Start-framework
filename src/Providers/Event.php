<?php

namespace Start\Providers;

use Start\Kernel\ServiceProvider;
use Illuminate\Events\Dispatcher;
use Illuminate\Contracts\Queue\Factory as QueueFactoryContract;
use Start\Event\Event as NurEvent;

class Event extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('events', function ($app) {
            return (new Dispatcher($app))->setQueueResolver(function () use ($app) {
                return $app->make(QueueFactoryContract::class);
            });
        });

        // Register Event-Listener Component of Nur
        $this->app->singleton(NurEvent::class, NurEvent::class);
    }
}
