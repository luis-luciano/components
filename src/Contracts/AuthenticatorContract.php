<?php

namespace LuisLuciano\Components\Contracts;

use LuisLuciano\Components\Models\User;

interface AuthenticatorContract
{
    public function check(): bool;
    public function user(): ?User;
}
