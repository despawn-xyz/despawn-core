<?php

namespace Despawn\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;
    use HasUlids;

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
