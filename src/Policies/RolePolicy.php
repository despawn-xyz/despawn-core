<?php

namespace Despawn\Policies;

use Despawn\Models\Role;
use Despawn\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Role $role)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->can('manage', Role::class);
    }

    public function update(User $user, Role $role)
    {
        if ($this::denyIfRoleIsLowerLevel($user, $role)) {
            return false;
        }

        return match (true) {
            $user->can('manage', Role::class) => true,
            default => false
        };
    }

    public function delete(User $user, Role $role)
    {
        if ($this::denyIfRoleIsLowerLevel($user, $role)) {
            return false;
        }

        return match (true) {
            Str::of($role->name)->exactly(Role::BANNED) => false,
            Str::of($role->name)->exactly(Role::SUPERADMIN) => false,
            Str::of($role->name)->exactly(Role::USER) => false,
            $user->can('manage', Role::class) => true,
            default => false
        };
    }

    public static function denyIfRoleIsLowerLevel(User $user, Role $role): bool
    {
        if ($user?->roles()?->first()?->is($role)) {
            return false;
        }

        return $user->roles?->first()?->level <= $role?->level;
    }
}
