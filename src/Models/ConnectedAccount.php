<?php

namespace Despawn\Models;

use Despawn\Traits\HasHumanTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class ConnectedAccount extends Model
{
    use HasUlids;
    use HasHumanTimestamps;

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getSharedData(): array
    {
        return [
            'id' => $this->id,
            'provider' => $this->provider,
            'avatar_path' => $this->avatar_path,
            'created_at' => $this->created_at,
            'created_at_for_humans' => $this->created_at_for_humans
        ];
    }
}