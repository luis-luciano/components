<?php

namespace LuisLuciano\Components\Stubs;

use LuisLuciano\Components\Contracts\AuthenticatorContract;
use LuisLuciano\Components\Models\User;

class AuthenticatorStub implements AuthenticatorContract
{
    public function __construct(protected bool $logged = true)
    {
    }

    public function check(): bool
    {
        return $this->logged;
    }

    public function user(): ?User
    {
        return new User(['role' => 'admin']);
    }
}
