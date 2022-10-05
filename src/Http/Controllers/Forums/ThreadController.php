<?php

namespace Despawn\Http\Controllers\Forums;

use Despawn\Http\Controllers\Controller;
use Despawn\Models\Thread;
use Inertia\Inertia;

class ThreadController extends Controller
{
    public function show(Thread $thread)
    {
        return Inertia::render('Forums/Thread/Index', [
            'thread' => $thread->loadMissing('author'),
        ]);
    }
}
