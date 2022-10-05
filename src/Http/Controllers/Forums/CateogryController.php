<?php

namespace Despawn\Http\Controllers\Forums;

use Despawn\Http\Controllers\Controller;
use Despawn\Models\Category;
use Inertia\Inertia;

class CateogryController extends Controller
{
    public function show(Category $category)
    {
        return Inertia::render('Forums/Category/Index', [
            'category' => $category->load('boards.threads'),
        ]);
    }
}
