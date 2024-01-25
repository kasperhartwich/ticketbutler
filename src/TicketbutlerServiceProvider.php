<?php

namespace Ticketbutler;

use Illuminate\Support\ServiceProvider;

class TicketbutlerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/ticketbutler.php' => config_path('ticketbutler.php'),
        ]);
    }

    public function register(): void
    {
        $this->app->bind(Ticketbutler::class, function () {
            return new Ticketbutler(config('ticketbutler.token'), config('ticketbutler.domain'));
        });
        $this->app->bind('ticketbutler', function () {
            return $this->app->make(Ticketbutler::class);
        });
        $this->mergeConfigFrom(__DIR__.'/../config/ticketbutler.php', 'ticketbutler');
    }
}
