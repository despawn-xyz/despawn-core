<?php

namespace Despawn\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use HasUlids;

    public function boards()
    {
        return $this->hasMany(Board::class);
    }
}
