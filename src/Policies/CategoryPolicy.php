<?php

namespace Despawn\Policies;

use Despawn\Models\Category;
use Despawn\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Arr;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function before(?User $user, $ability)
    {
        if ($user?->can('administrator')) {
            return true;
        }
    }

    public function viewAny()
    {
        return true;
    }

    public function view(?User $user, Category $category)
    {
        if ($category?->private) {
            return static::checkIfPrivate($user, $category);
        }

        if (! isset($user)) {
            return true;
        }

        return true;
    }

    public function create(User $user)
    {
        return $user->can('manage', Category::class);
    }

    public function update(User $user, Category $category)
    {
        return $user->can('manage', Category::class);
    }

    public function delete(User $user, Category $category)
    {
        return $user->can('manage', Category::class);
    }

    public function restore(User $user, Category $category)
    {
        return $user->can('manage', Category::class);
    }

    public function forceDelete(User $user, Category $category)
    {
        return $user->can('manage', Category::class);
    }

    public static function checkIfPrivate(?User $user, Category $category)
    {
        if (! isset($user)) {
            return false;
        }

        return match (true) {
            Arr::has($category?->allowed_roles, $user?->getRoles()) => true,
            Arr::has($category?->allowed_users, $user?->name) => true,
            default => false
        };
    }
}
