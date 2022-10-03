<?php

namespace Despawn\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasHumanTimestamps
{
    public function createdAtForHumans(): Attribute
    {
        return new Attribute(
            get: fn () => $this?->created_at->diffForHumans()
        );
    }

    public function updatedAtForHumans(): Attribute
    {
        return new Attribute(
            get: fn () => $this?->updated_at->diffForHumans()
        );
    }
}
