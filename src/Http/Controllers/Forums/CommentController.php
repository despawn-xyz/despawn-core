<?php

namespace Despawn\Http\Controllers\Forums;

use Despawn\Http\Controllers\Controller;
use Despawn\Http\Requests\Forums\Comment\CommentStoreRequest;
use Despawn\Models\Thread;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request, Thread $thread)
    {
        $comment = $request->safe(['body', 'commenter_id', 'commenter_type']);

        $thread->comments()->create($comment);

        return to_route('forums.thread.show', $thread);
    }
}
