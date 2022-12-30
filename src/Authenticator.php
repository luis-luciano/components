<?php

namespace LuisLuciano\Components;

use LuisLuciano\Components\SessionManager as Session;

class Authenticator
{
    protected static ?User $user = null;

    public static function check(): bool
    {
        return static::user() != null;
    }

    public static function user(): ?User
    {
        if (!is_null(static::$user)) {
            return static::$user;
        }

        $data = Session::get('user_data');

        if (!is_null($data)) {
            return static::$user = new User($data);
        }

        return null;
    }
}
