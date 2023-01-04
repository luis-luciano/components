<?php

namespace LuisLuciano\Components;

use LuisLuciano\Components\Contracts\SessionDriverContract;

class SessionManager
{
    protected array $data = [];

    public function __construct(protected SessionDriverContract $driver)
    {
        $this->load();
    }

    public function load()
    {
        $this->data = $this->driver->load();
    }

    public function get(string $key)
    {
        return $this->data[$key] ?? null;
    }
}
