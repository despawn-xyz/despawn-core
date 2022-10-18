<?php

namespace Despawn\Providers;

use Despawn\Console\Commands\Install;
use Despawn\Console\Commands\Setup;
use Despawn\Console\Commands\Update;
use Despawn\Models\Ability;
use Despawn\Models\Comment;
use Despawn\Models\Role;
use Despawn\Models\Thread;
use Despawn\Observers\CommentObserver;
use Despawn\Observers\ThreadObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Silber\Bouncer\BouncerFacade;

class DespawnServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadPublishers();
        $this->loadMergers();
        $this->loadCommands();
        $this->loadPasswordDefaults();
    }

    private function loadPublishers(): void
    {
        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/despawn'),
        ], 'despawn-views');

        $this->publishes([
            __DIR__ . '/../../config/despawn-core.php' => config_path('despawn-core.php'),
        ], 'despawn-config');

        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/despawn'),
        ], ['despawn-assets', 'laravel-assets']);
    }

    private function loadMergers()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/despawn-core.php',
            'despawn-core'
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
            Setup::class,
        ]);
    }

    private function loadPasswordDefaults()
    {
        Password::defaults(function () {
            $rule = Password::min(8);

            return $rule->mixedCase()->uncompromised();
        });
    }
}
