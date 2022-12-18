<?php

namespace Despawn\Models;

use Despawn\Traits\HasHumanTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory;
    use HasUlids;
    use HasHumanTimestamps;
    use \Spatie\Sluggable\HasSlug;

    protected $appends = [
        'created_at_for_humans',
        'updated_at_for_humans',
    ];

    protected $casts = [
        'private' => 'boolean',
        'allowed_users' => 'array',
        'allowed_roles' => 'array',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50)
            ->doNotGenerateSlugsOnUpdate();
    }

    public function boards()
    {
        return $this->hasMany(Board::class)->orderBy('weight');
    }
}
