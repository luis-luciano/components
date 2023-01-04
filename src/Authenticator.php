<?php

namespace LuisLuciano\Components;

use LuisLuciano\Components\Contracts\AuthenticatorContract;
use LuisLuciano\Components\Models\User;
use LuisLuciano\Components\SessionManager as Session;

class Authenticator implements AuthenticatorContract
{
    protected ?User $user = null;

    public function __construct(protected Session $session)
    {
    }

    public function check(): bool
    {
        return $this->user() != null;
    }

    public function user(): ?User
    {
        if (!is_null($this->user)) {
            return $this->user;
        }

        $data = $this->session->get('user_data');

        if (!is_null($data)) {
            return $this->user = new User($data);
        }

        return null;
    }
}
