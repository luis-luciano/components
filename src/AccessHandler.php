<?php

namespace LuisLuciano\Components;

use LuisLuciano\Components\Authenticator as Auth;

class AccessHandler
{
    public static function check(string $role)
    {
        return Auth::check() && Auth::user()->role == $role;
    }
}
