<?php

namespace Despawn\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    use HasUlids;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
