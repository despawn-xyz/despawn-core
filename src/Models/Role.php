<?php

namespace Despawn\Models;

class Role extends \Silber\Bouncer\Database\Role
{
    public const SUPERADMIN = 'superadmin';
    public const BANNED = 'banned';
    public const USER = 'user';
}