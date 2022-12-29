<?php

namespace LuisLuciano\Components;

class AccessHandler
{
    public static function check(string $role)
    {
        return 'admin' === $role;
    }
}
