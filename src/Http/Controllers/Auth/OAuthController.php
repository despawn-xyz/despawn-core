<?php

namespace Despawn\Http\Controllers\Auth;

use Despawn\Http\Controllers\Controller;
use Despawn\Models\ConnectedAccount;
use Despawn\Models\User;
use Exception;
use App\Http\RouteServiceProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class OAuthController extends Controller
{
    // TODO: fix this whole piece of shit
    /**
     * @throws Exception
     */
    public function redirect(string $provider)
    {
        if (Arr::has(config('services'), $provider)) {
            return Socialite::driver($provider)->redirect();
        }

        throw new Exception('Provider: ' . $provider  . ' does not exist.');
    }

    /**
     * @throws Throwable
     */
    public function callback(string $driver)
    {
        $account = Socialite::driver($driver)->user();

        $connectedAccount = ConnectedAccount::whereProviderId($account->getId())->first();

        if (\auth()->check()) {
            $this->createConnectedAccountFromDriver($driver, $account, auth()->user());

            return to_route('home');
        }

        if ($connectedAccount?->exists()) {
            if (Auth::check() && $connectedAccount->user_id !== \auth()?->user()?->id) {
                // TODO: decide how to handle flash
                dd('driver is already registered sorry!');
            }

            Auth::login($connectedAccount->user);
            return to_route('home');
        }

        $user = $this->createUserFromDriver($driver, $account);
        $this->createConnectedAccountFromDriver($driver, $account, $user);

        Auth::login($user);
        return to_route('home');
    }

    /**
     * @throws Throwable
     */
    protected function createUserFromDriver(string $driver, \Laravel\Socialite\Contracts\User $driverUser)
    {
        $user = User::create([
            'name' => $driverUser->getNickname(),
            'email' => $driverUser->getEmail() ?? $driverUser->getNickname().'@' . $driver,
            'slug' => Str::slug($driverUser->getNickname())
        ]);

        return $user;
    }

    /**
     * @throws Exception
     */
    private function createConnectedAccountFromDriver(string $driver, \Laravel\Socialite\Contracts\User $account, Authenticatable $user): void
    {
        $user->connectedAccounts()->create([
            'provider' => strtolower($driver),
            'provider_id' => $account->getId(),
            'name' => $account->getName(),
            'nickname' => $account->getNickname(),
            'email' => $account->getEmail(),
            'avatar_path' => $account->getAvatar(),
            'token' => $account->token,
            'secret' => $account->tokenSecret ?? null,
            'refresh_token' => $account->refreshToken ?? null,
            'expires_at' => property_exists($account, 'expiresIn') ? now()->addSeconds($account->expiresIn) : null,
        ]);
    }
}