<?php

namespace LuisLuciano\Components;

class SessionFileDriver
{
    const PATH = '/../storage/session/';

    public function load(): array
    {
        $file =  __DIR__ . static::PATH . 'session.json';

        if (file_exists($file)) {
            return json_decode(file_get_contents($file), true);
        }

        return [];
    }
}
