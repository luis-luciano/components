<?php

namespace LuisLuciano\Components\Tests;

use LuisLuciano\Components\AccessHandler as Access;
use PHPUnit\Framework\TestCase;

class AccessHandlerTest extends TestCase
{
    public function test_grant_access()
    {
        $this->assertTrue(Access::check('admin'));
    }

    public function test_deny_access()
    {
        $this->assertFalse(Access::check('editor'));
    }
}
