<?php

namespace Despawn\Http\Controllers\Forums;

use Despawn\Http\Controllers\Controller;
use Despawn\Models\Board;
use Inertia\Inertia;

class BoardController extends Controller
{
    public function show(Board $board)
    {
        return Inertia::render('Forums/Board/Index', [
            'board' => $board->loadMissing('threads'),
        ]);
    }
}
