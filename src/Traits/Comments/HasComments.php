<?php

namespace Despawn\Traits\Comments;

use Despawn\Models\Comment;

trait HasComments
{
    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}