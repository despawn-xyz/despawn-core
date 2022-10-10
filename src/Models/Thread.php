<?php

namespace Despawn\Models;

use Despawn\Traits\HasHumanTimestamps;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Thread extends Model
{
    use HasFactory;
    use HasUlids;
    use HasHumanTimestamps;
    use HasSlug;

    protected $with = [
        'author',
    ];

    protected $withCount = [
        'comments',
    ];

    protected $appends = [
        'was_recently_updated',
        'created_at_for_humans',
        'updated_at_for_humans',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50)
            ->doNotGenerateSlugsOnUpdate();
    }

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function board(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Board::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function wasRecentlyUpdated(): Attribute
    {
        return new Attribute(
            get: fn () => $this->created_at->eq($this->updated_at)
        );
    }
}
