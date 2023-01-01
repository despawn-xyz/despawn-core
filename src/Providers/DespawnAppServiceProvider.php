<?php

namespace Despawn\Providers;

use Despawn\Models\Ability;
use Despawn\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Silber\Bouncer\BouncerFacade;
class DespawnAppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Model::unguard();

        Model::shouldBeStrict();

        BouncerFacade::useAbilityModel(Ability::class);
        BouncerFacade::useRoleModel(Role::class);
    }

    public function register()
    {
        //
    }
}
