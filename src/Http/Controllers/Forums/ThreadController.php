<?php

namespace Despawn\Http\Controllers\Forums;

use Despawn\Http\Controllers\Controller;
use Despawn\Http\Requests\Forums\Thread\ThreadStoreRequest;
use Despawn\Models\Board;
use Despawn\Models\Thread;
use Inertia\Inertia;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only(['create', 'store']);
    }

    public function show(Thread $thread)
    {
        return Inertia::render('Forums/Thread/Show', [
            'thread' => $thread->loadMissing('author'),
            'board' => $thread->board,
            'category' => $thread->board->category
        ]);
    }

    public function create(Board $board)
    {
        return Inertia::render('Forums/Thread/Create', [
            'board' => $board
        ]);
    }

    public function store(ThreadStoreRequest $request, Board $board)
    {
        $thread = $board->threads()->create($request->safe(['title', 'body', 'slug', 'user_id']));

        return to_route('forums.thread.show', $thread);
    }
}