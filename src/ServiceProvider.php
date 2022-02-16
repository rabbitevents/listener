<?php

declare(strict_types=1);

namespace RabbitEvents\Listener;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use RabbitEvents\Listener\Commands\EventsListCommand;
use RabbitEvents\Listener\Commands\RegisterCommand;
use RabbitEvents\Listener\Commands\ListenCommand;
use RabbitEvents\Listener\Facades\RabbitEvents;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected array $listen = [];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            RegisterCommand::class,
            ListenCommand::class,
            EventsListCommand::class,
        ]);

        foreach ($this->listen as $event => $listeners) {
            foreach ($listeners as $listener) {
                RabbitEvents::listen($event, $listener);
            }
        }
    }

    public function register(): void
    {
        $this->registerPublishing();
    }

    /**
     * Setup the resource publishing groups for RabbitEvents.
     *
     * @return void
     */
    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . "/../stubs/RabbitEventsServiceProvider.stub" => $this->app->path("Providers/RabbitEventsServiceProvider.php"),
            ], 'rabbitevents-listener-provider');
        }
    }
}
