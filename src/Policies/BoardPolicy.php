<?php

namespace Despawn\Policies;

use Despawn\Models\Board;
use Despawn\Models\User;
use Illuminate\Support\Arr;

class BoardPolicy
{
    public function before(?User $user, $ability)
    {
        if ($user?->can('administrator')) {
            return true;
        }
    }

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, Board $board)
    {
        $category = $board->loadMissing('category')->category;

        return match (true) {
            $category->private => CategoryPolicy::checkIfPrivate($user, $category),
            $board->private => static::checkIfPrivate($user, $board),
            default => true,
        };
    }

    public function create(User $user)
    {
        return $user->can('manage', Board::class);
    }

    public function update(User $user, Board $board)
    {
        return $user->can('manage', Board::class);
    }

    public function delete(User $user, Board $board)
    {
        return $user->can('manage', Board::class);
    }

    public function restore(User $user, Board $board)
    {
        //
    }

    public function forceDelete(User $user, Board $board)
    {
        //
    }

    public static function checkIfPrivate(?User $user, Board $board)
    {
        if (! isset($user)) {
            return false;
        }

        return match (true) {
            Arr::has($board?->allowed_roles, $user?->getRoles()->toArray()) => true,
            Arr::has($board?->allowed_users, $user?->name) => true,
            default => false
        };
    }
}
