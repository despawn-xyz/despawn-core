<form wire:submit.prevent="authenticate" class="space-y-8">
    <x-filament-support::button tag="a" href="{{ route('oauth.redirect', 'steam') }}" class="w-full">
        {{ __('Login with Steam') }}
    </x-filament-support::button>
</form>