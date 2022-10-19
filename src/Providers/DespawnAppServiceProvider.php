<?php

namespace Despawn\Providers;

use Despawn\Models\Ability;
use Despawn\Models\Comment;
use Despawn\Models\Role;
use Despawn\Models\Thread;
use Despawn\Models\User;
use Despawn\Observers\CommentObserver;
use Despawn\Observers\ThreadObserver;
use Despawn\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use Silber\Bouncer\BouncerFacade;
use Illuminate\Database\Eloquent\Model;

class DespawnAppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Model::unguard();

        Model::shouldBeStrict();

        BouncerFacade::useAbilityModel(Ability::class);
        BouncerFacade::useRoleModel(Role::class);

        Thread::observe(ThreadObserver::class);
        Comment::observe(CommentObserver::class);
        User::observe(UserObserver::class);
    }

    public function register()
    {
        //
    }
}