<?php

namespace Despawn\Providers;

use Despawn\Console\Commands\Install;
use Despawn\Console\Commands\Update;
use Illuminate\Support\ServiceProvider;

class DespawnServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadPublishers();
        $this->loadMergers();
        $this->loadCommands();
    }

    private function loadPublishers(): void
    {
        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/despawn'),
        ], 'despawn-views');

        $this->publishes([
            __DIR__ . '/../../config/despawn.php' => config_path('despawn.php'),
        ], 'despawn-config');

        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/despawn'),
        ], ['despawn-assets', 'laravel-assets']);
    }

    private function loadMergers()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/despawn.php',
            'despawn'
        );

        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'despawn');
    }

    private function loadCommands()
    {
        $this->commands([
            Install::class,
            Update::class,
        ]);
    }
}
