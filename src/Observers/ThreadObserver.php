<?php

namespace Despawn\Observers;

use Despawn\Models\Comment;
use Despawn\Models\Thread;

class ThreadObserver
{
    public function created(Thread $thread)
    {
        //
    }

    public function updated(Thread $thread)
    {
        //
    }

    public function deleted(Thread $thread)
    {
        //
    }

    public function restored(Thread $thread)
    {
        //
    }

    public function forceDeleted(Thread $thread)
    {
        $thread->comments()->cursor()->each(fn (Comment $comment) => $comment->forceDelete());
    }
}
