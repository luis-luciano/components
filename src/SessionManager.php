<?php

namespace LuisLuciano\Components;

class SessionManager
{
    protected array $data = [];

    public function __construct(protected SessionFileDriver $driver)
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
