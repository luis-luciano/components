<?php

namespace LuisLuciano\Components;

use Closure;

class Container
{
    protected $bindings = [];
    protected $shared = [];

    /**
     * @param string $name
     * @param Closure|string $resolver
     *
     * @return void
     */
    public function bind(string $name, $resolver)
    {
        $this->bindings[$name] = ['resolver' => $resolver];
    }

    /**
     * @param string $name
     * @param mixed $object
     *
     * @return void
     */
    public function instance(string $name, $object)
    {
        $this->shared[$name] = $object;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function make(string $name)
    {
        if (array_key_exists($name, $this->shared)) {
            return $this->shared[$name];
        }

        $resolver = $this->bindings[$name]['resolver'];

        if ($resolver instanceof Closure) {
            $object = $resolver($this);
        } else {
            $object = new $resolver;
        }

        return $object;
    }
}
