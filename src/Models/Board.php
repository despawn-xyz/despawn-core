<?php

namespace Despawn\Models;

use Despawn\Traits\HasHumanTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Board extends Model
{
    use HasFactory;
    use HasUlids;
    use HasHumanTimestamps;
    use HasSlug;

//    protected $appends = [
//        '',
//    ];

    protected $casts = [
        'threads_count' => 'integer',
        'comments_count' => 'integer',
        'private' => 'boolean',
        'allowed_users' => 'array',
        'allowed_roles' => 'array',
    ];

    protected $withCount = [
        'threads',
        'comments',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50)
            ->doNotGenerateSlugsOnUpdate();
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Board::class)->orderBy('weight');
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Board::class, 'parent_id')->orderBy('weight');
    }

    public function threads(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Thread::class);
    }

    public function latestThread(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Thread::class)->latestOfMany('created_at');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(Comment::class, Thread::class, 'board_id', 'commentable_id');
    }
}
