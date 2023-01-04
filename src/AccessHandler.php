<?php

namespace LuisLuciano\Components;

use LuisLuciano\Components\Authenticator as Auth;

class AccessHandler
{
    public function __construct(private Auth $auth)
    {
    }

    public function check(string $role)
    {
        return $this->auth->check() && $this->auth->user()->role == $role;
    }
}
