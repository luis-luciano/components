<?php

namespace LuisLuciano\Components\Tests;

use LuisLuciano\Components\AccessHandler as Access;
use LuisLuciano\Components\Stubs\AuthenticatorStub;
use PHPUnit\Framework\TestCase;

class AccessHandlerTest extends TestCase
{
    public function test_grant_access()
    {
        $auth = new AuthenticatorStub();
        $access = new Access($auth);
        $this->assertTrue($access->check('admin'));
    }

    public function test_deny_access()
    {
        $auth = new AuthenticatorStub();
        $access = new Access($auth);
        $this->assertFalse($access->check('editor'));
    }
}
