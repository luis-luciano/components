<?php

namespace LuisLuciano\Components;

class User
{
    public function __construct(protected array $attributes)
    {
    }

    public function __get(string $attribute)
    {
        return $this->attributes[$attribute] ?? null;
    }
}
