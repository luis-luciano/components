<?php

namespace LuisLuciano\Components;

use LuisLuciano\Components\Contracts\AuthenticatorContract as Auth;

class AccessHandler
{
    public function __construct(private Auth $auth)
    {
    }

    /**
     * @param string $role
     *
     * @return bool
     */
    public function check(string $role): bool
    {
        return $this->auth->check() && $this->auth?->user()?->role == $role;
    }
}
