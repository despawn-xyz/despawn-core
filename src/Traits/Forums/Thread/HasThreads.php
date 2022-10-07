<?php

namespace Despawn\Traits\Forums\Thread;

use Despawn\Models\Thread;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasThreads
{
    public function threads(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Thread::class);
    }

    public function threadsCount(): Attribute
    {
        return new Attribute(
            get: fn () => $this->threads()->count()
        );
    }
}