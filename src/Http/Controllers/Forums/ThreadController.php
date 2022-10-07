<?php

namespace Despawn\Http\Controllers\Forums;

use Despawn\Http\Controllers\Controller;
use Despawn\Http\Requests\Forums\Thread\ThreadStoreRequest;
use Despawn\Http\Requests\Forums\Thread\ThreadUpdateRequest;
use Despawn\Models\Board;
use Despawn\Models\Thread;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except(['show']);
    }

    public function show(Thread $thread)
    {
        return Inertia::render('Forums/Thread/Show', [
            'thread' => $thread->loadMissing(['author', 'comments.commenter']),
            'board' => $thread->board,
            'category' => $thread->board->category,
        ]);
    }

    public function create(Board $board)
    {
        return Inertia::render('Forums/Thread/Create', [
            'board' => $board,
        ]);
    }

    public function store(ThreadStoreRequest $request, Board $board)
    {
        $thread = $board->threads()->create($request->safe(['title', 'body', 'slug', 'user_id']));

        return to_route('forums.thread.show', $thread);
    }

    public function update(ThreadUpdateRequest $request, Thread $thread)
    {
        $thread->update($request->safe(['title', 'body']));

        return to_route('forums.thread.show', $thread);
    }

    public function destroy(Request $request, Thread $thread)
    {
        $thread->forceDelete();

        return to_route('home');
    }
}
