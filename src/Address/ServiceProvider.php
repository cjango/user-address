<?php

namespace Jason\Address;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../../config/config.php' => config_path('address.php')]);
            $this->publishes([__DIR__ . '/../../database/migrations/' => database_path('migrations')]);
            $this->publishes([__DIR__ . '/../../database/seeders/' => database_path('seeders')]);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'address');
    }

}
