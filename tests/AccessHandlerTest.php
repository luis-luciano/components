<?php

namespace LuisLuciano\Components\Tests;

use LuisLuciano\Components\AccessHandler as Access;
use LuisLuciano\Components\Contracts\AuthenticatorContract;
use LuisLuciano\Components\Models\User;
use LuisLuciano\Components\Stubs\AuthenticatorStub;
use Mockery;
use PHPUnit\Framework\TestCase;

class AccessHandlerTest extends TestCase
{
    /**
     * This method is called after each test.
     */
    protected function tearDown(): void
    {
        Mockery::close();
    }

    protected function getAuthenticatorMock(): AuthenticatorContract
    {
        $user = Mockery::mock(User::class);
        $user->role = 'admin';

        $auth = Mockery::mock(AuthenticatorContract::class);
        $auth->expects()
            ->check()
            ->once()
            ->andReturn(true);
        $auth->expects()
            ->user()
            ->once()
            ->andReturn($user);

        return $auth;
    }
    public function test_grant_access()
    {
        $auth = $this->getAuthenticatorMock();
        $access = new Access($auth);

        $this->assertTrue($access->check('admin'));
    }

    public function test_deny_access()
    {
        $auth = $this->getAuthenticatorMock();
        $access = new Access($auth);
        $this->assertFalse($access->check('editor'));
    }
}
