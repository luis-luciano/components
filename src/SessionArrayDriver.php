<?php

namespace LuisLuciano\Components;

use LuisLuciano\Components\Contracts\SessionDriverContract;

class SessionArrayDriver implements SessionDriverContract
{
    public function __construct(protected array $data = [])
    {
    }

    public function load(): array
    {
        return $this->data;
    }
}
