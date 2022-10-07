<?php

namespace Despawn\Models;

use Despawn\Traits\HasHumanTimestamps;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use HasUlids;
    use HasHumanTimestamps;

    protected $appends = [
        'was_recently_updated',
        'created_at_for_humans',
        'updated_at_for_humans',
    ];

    protected $touches = [
        'commentable',
    ];

    public function commenter(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function commentable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function wasRecentlyUpdated(): Attribute
    {
        return new Attribute(
            get: fn () => $this->created_at->eq($this->updated_at)
        );
    }
}
