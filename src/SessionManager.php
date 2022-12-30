<?php

namespace LuisLuciano\Components;

class SessionManager
{
    protected static bool $loaded = false;
    protected static array $data = [];

    public static function load()
    {
        if (static::$loaded) return;

        static::$data = SessionFileDriver::load();

        static::$loaded = true;
    }

    public static function get(string $key)
    {
        static::load();

        return static::$data[$key] ?? null;
    }
}
