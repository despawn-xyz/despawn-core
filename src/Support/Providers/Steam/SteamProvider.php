<?php

namespace Despawn\Support\Providers\Steam;

use Illuminate\Support\Arr;
use SocialiteProviders\Manager\OAuth2\User;

class SteamProvider extends \SocialiteProviders\Steam\Provider
{
    protected function mapUserToObject(array $user): \Laravel\Socialite\Two\User|User
    {
        return (new User())->setRaw($user)->map([
            'id' => $user['steamid'],
            'nickname' => Arr::get($user, 'personaname'),
            'name' => Arr::get($user, 'realname'),
            'email' => null,
            'avatar' => Arr::get($user, 'avatarfull'),
        ]);
    }

    private function buildUrl(): string
    {
        $realm = $this->getConfig('realm', $this->request->server('HTTP_HOST'));

        $protocol = env('APP_IS_PROXIED', true) ? 'https' : $this->request->getScheme();

        $params = [
            'openid.ns' => self::OPENID_NS,
            'openid.mode' => 'checkid_setup',
            'openid.return_to' => $this->redirectUrl,
            'openid.realm' => sprintf('%s://%s', $protocol, $realm),
            'openid.identity' => 'http://specs.openid.net/auth/2.0/identifier_select',
            'openid.claimed_id' => 'http://specs.openid.net/auth/2.0/identifier_select',
        ];

        return self::OPENID_URL . '?' . http_build_query($params, '', '&');
    }
}