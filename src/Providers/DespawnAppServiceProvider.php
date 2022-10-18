<?php

namespace Despawn\Providers;

use Despawn\Models\Ability;
use Despawn\Models\Comment;
use Despawn\Models\Role;
use Despawn\Models\Thread;
use Despawn\Observers\CommentObserver;
use Despawn\Observers\ThreadObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Silber\Bouncer\BouncerFacade;

class DespawnAppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Model::unguard();

        BouncerFacade::useAbilityModel(Ability::class);
        BouncerFacade::useRoleModel(Role::class);

        Thread::observe(ThreadObserver::class);
        Comment::observe(CommentObserver::class);
    }

    public function register()
    {
    }
}
