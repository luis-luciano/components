<?php

namespace LuisLuciano\Components\Tests;

use LuisLuciano\Components\Container;
use LuisLuciano\Components\Exceptions\ContainerNotFoundClassException;
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

class Qux
{
    public function __construct(Norf $norf)
    {
    }
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

    public function test_expected_container_exception_if_dependency_does_not_exist()
    {
        $this->expectException(ContainerNotFoundClassException::class);

        $container = new Container();

        $container->bind('qux', Qux::class);

        $container->make('qux');
    }

    public function test_class_does_not_exist()
    {
        $this->expectException(ContainerNotFoundClassException::class);

        $container = new Container();

        $container->make('Norf');
    }
}
