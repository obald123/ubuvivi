<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    public function test_super_admin_has_admin_access_and_super_admin_privileges()
    {
        $user = new User(['role' => User::ROLE_SUPER_ADMIN]);

        $this->assertTrue($user->isAdmin());
        $this->assertTrue($user->isSuperAdmin());
    }

    public function test_regular_admin_does_not_have_super_admin_privileges()
    {
        $user = new User(['role' => User::ROLE_ADMIN]);

        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isSuperAdmin());
    }

    public function test_regular_users_do_not_have_admin_access()
    {
        $user = new User(['role' => 'client']);

        $this->assertFalse($user->isAdmin());
        $this->assertFalse($user->isSuperAdmin());
    }
}
