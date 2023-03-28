<?php

namespace LuisLuciano\Components\Tests;

use LuisLuciano\Components\Container;
use PHPUnit\Framework\TestCase;
use stdClass;

class Foo
{
    public function __construct(Bar $bar)
    {
    }
}

class Bar
{
    public function __construct(FooBar $fooBar)
    {
    }
}

class FooBar
{
}

class ContainerTest extends TestCase
{
    public function test_bind_from_closure()
    {
        $container = new Container();

        $container->bind('key', fn () => 'Object');
        $this->assertSame('Object', $container->make('key'));
    }

    public function test_bind_instance()
    {
        $container = new Container();
        $stdClass = new stdClass();
        $container->instance('key', $stdClass);

        $this->assertSame($stdClass, $container->make('key'));
    }

    public function test_bind_from_class_name()
    {
        $container = new Container();

        $container->bind('key', Foo::class);

        $this->assertInstanceOf(Foo::class, $container->make('key'));
    }

    public function test_bind_with_automatic_resolution()
    {
        $container = new Container();

        $container->bind('foo', Foo::class);

        $this->assertInstanceOf(Foo::class, $container->make('foo'));
    }
}
