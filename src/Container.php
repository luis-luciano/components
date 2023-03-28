<?php

namespace LuisLuciano\Components;

use Closure;
use InvalidArgumentException;
use LuisLuciano\Components\Exceptions\ContainerNotFoundClassException;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;

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

        $resolver = $this->bindings[$name]['resolver'] ?? $name;

        if ($resolver instanceof Closure) {
            $object = $resolver($this);
        } else {
            $object = $this->build($resolver);
        }

        return $object;
    }

    public function build(string $name)
    {
        try {
            $reflection = new ReflectionClass($name);
        } catch (ReflectionException $e) {
            throw new ContainerNotFoundClassException("The name: [$name] must be a class. " . $e->getMessage(), 500, $e);
        }

        if (!$reflection->isInstantiable()) {
            throw new InvalidArgumentException("{$name} is not instantiable");
        }

        $constructor = $reflection->getConstructor();

        if (empty($constructor)) {
            return new $name;
        }

        $arguments = [];
        $constructorParameters = $constructor->getParameters();

        foreach ($constructorParameters as $constructorParameter) {
            if (!($constructorParameter->getType() instanceof ReflectionNamedType)) {
                continue;
            }

            // Get and create instance
            $parameterClassName = $constructorParameter->getType()->getName();
            $arguments[] = $this->build($parameterClassName);
        }

        return $reflection->newInstanceArgs($arguments);
    }
}
