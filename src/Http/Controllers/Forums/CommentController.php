<?php

namespace Despawn\Http\Controllers\Forums;

use Despawn\Http\Controllers\Controller;
use Despawn\Http\Requests\Forums\Comment\CommentStoreRequest;
use Despawn\Http\Requests\Forums\Comment\CommentUpdateRequest;
use Despawn\Models\Comment;
use Despawn\Models\Thread;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function store(CommentStoreRequest $request, Thread $thread)
    {
        $comment = $request->safe(['body', 'commenter_id', 'commenter_type']);

        $thread->comments()->create($comment);

        return to_route('forums.thread.show', $thread);
    }

    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $comment->update($request->safe(['body']));

        return to_route('forums.thread.show', $comment->commentable);
    }

    public function destroy(Request $request, Comment $comment)
    {
        $comment->forceDelete();

        return back();
    }
}
