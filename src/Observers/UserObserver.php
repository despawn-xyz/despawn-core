<?php

namespace Despawn\Observers;

use Despawn\Models\Comment;
use Despawn\Models\Thread;
use Despawn\Models\User;
use Silber\Bouncer\BouncerFacade;

class UserObserver
{
    public function created(User $user)
    {
        match (true) {
            (User::count() <= 1) => BouncerFacade::assign('superadmin')->to($user),
            default => BouncerFacade::assign('user')->to($user)
        };
    }

    public function updated(User $user)
    {
        //
    }

    public function deleted(User $user)
    {
        //
    }

    public function restored(User $user)
    {
        //
    }

    public function forceDeleted(User $user)
    {
        $user->threads()->cursor()->each(fn (Thread $thread) => $thread->forceDelete());
        $user->comments()->cursor()->each(fn (Comment $comment) => $comment->forceDelete());
    }
}
