<?php

namespace Despawn\Http\Controllers;

use Despawn\Models\Category;
use Despawn\Models\Thread;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Welcome', [
            'categories' => Category::with(['boards.latestThread'])->get(),
            'latest_threads' => Thread::orderBy('updated_at')->get()
        ]);
    }
}