<?php

// use Illuminate\Contracts\Auth\MustVerifyEmail;

namespace Despawn\Models;

use Despawn\Traits\Comments\HasComments;
use Despawn\Traits\Forums\Thread\HasThreads;
use Despawn\Traits\HasHumanTimestamps;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasUlids;
    use HasHumanTimestamps;
    use HasThreads;
    use HasComments;
    use HasSlug;

    protected $appends = [
        'avatar',
        'created_at_for_humans',
        'updated_at_for_humans',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50)
            ->doNotGenerateSlugsOnUpdate();
    }

    public function connectedAccounts(): HasMany
    {
        return $this->hasMany(ConnectedAccount::class);
    }

    public function canAccessFilament(): bool
    {
        // TODO: Update this for production
        return true;
    }

    public function getAvatarAttribute()
    {
        return match (true) {
            isset($this->connectedAccounts()?->first()?->avatar_path) => $this->connectedAccounts()?->first()?->avatar_path,
            default => "https://source.boringavatars.com/beam/40/{$this->name}"
        };
    }
}
