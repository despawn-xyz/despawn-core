<?php

namespace Despawn\Models;

use Despawn\Traits\HasHumanTimestamps;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use HasUlids;
    use HasHumanTimestamps;

    protected $appends = [
        'created_at_for_humans',
        'updated_at_for_humans',
    ];

    public function boards()
    {
        return $this->hasMany(Board::class)->orderBy('weight');
    }
}
