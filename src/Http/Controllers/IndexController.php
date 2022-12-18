<?php

namespace Despawn\Http\Controllers;

use Despawn\Models\Category;
use Despawn\Models\Thread;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Welcome', [
            'categories' => Category::with(['boards.latestThread'])->get()->map(function ($category) {
                return [
                    'id' => $category->id,
                    'title' => $category->title,
                    'slug' => $category->slug,
                    'boards' => $category->boards->map(function ($board) {
                        return [
                            'id' => $board->id,
                            'title' => $board->title,
                            'slug' => $board->slug,
                            'description' => $board->description,
                            'latest_thread' => $board->latestThread,
                            'threads_count' => $board->threads_count,
                            'can' => [
                                'view_board' => Gate::forUser(auth()->user())->check('view', $board),
                            ],
                        ];
                    }),
                    'can' => [
                        'view_category' => Gate::forUser(auth()->user())->check('view', $category),
                    ],
                ];
            }),
            'latest_threads' => Thread::orderBy('updated_at')->get(),
        ]);
    }
}
