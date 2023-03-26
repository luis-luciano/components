<?php

namespace LuisLuciano\Components;

class ContainerV1
{
    protected array $shared = [];
    protected static ContainerV1 $container;

    public static function getInstance(): ContainerV1
    {
        if (empty(static::$container)) {
            static::$container = new ContainerV1;
        }

        return static::$container;
    }

    public static function set(ContainerV1 $container)
    {
        static::$container = $container;
    }

    public static function clear()
    {
        static::$container = null;
    }

    public function getSession(): SessionManager
    {
        $data = [
            'user_data' => [
                'name' => 'Luis',
                'role' => 'teacher'
            ]
        ];

        $driver = new SessionArrayDriver($data);
        return $this->shared['session'] = new SessionManager($driver);
    }

    /**
     * @return Authenticator
     */
    public function getAuth(): Authenticator
    {
        return $this->shared['auth'] ?? $this->shared['auth'] = new Authenticator($this->getSession());
    }

    public function getAccess(): AccessHandler
    {
        return $this->shared['access'] ?? $this->shared['access'] = new AccessHandler($this->getAuth());
    }
}
