<?php

namespace LuisLuciano\Components\Tests;

use LuisLuciano\Components\AccessHandler as Access;
use LuisLuciano\Components\Authenticator as Auth;
use LuisLuciano\Components\SessionManager as Session;
use LuisLuciano\Components\SessionFileDriver as Driver;
use PHPUnit\Framework\TestCase;

class AccessHandlerTest extends TestCase
{
    public function test_grant_access()
    {
        $driver = new Driver();
        $session = new Session($driver);
        $auth = new Auth($session);
        $access = new Access($auth);
        $this->assertTrue($access->check('admin'));
    }

    public function test_deny_access()
    {
        $driver = new Driver();
        $session = new Session($driver);
        $auth = new Auth($session);
        $access = new Access($auth);
        $this->assertFalse($access->check('editor'));
    }
}
