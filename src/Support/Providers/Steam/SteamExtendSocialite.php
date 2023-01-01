<?php

namespace Despawn\Support\Providers\Steam;

use SocialiteProviders\Manager\SocialiteWasCalled;

class SteamExtendSocialite
{
    /**
     * Register the provider.
     *
     * @param  \SocialiteProviders\Manager\SocialiteWasCalled  $socialiteWasCalled
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('steam', SteamProvider::class);
    }
}