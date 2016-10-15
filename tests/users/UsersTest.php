<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    use DatabaseTransactions;

    public function testUsersRoute()
    {
        $this->visit('/users')
            ->see('Users Index');

        $this->assertResponseOk();
    }

    public function testUsersNavigation()
    {
        $this->visit('/')
            ->click('Users')
            ->seePageIs('/users');
    }

    public function testUsersViewHasData()
    {
        $this->visit('/users')
            ->seePageIs('/users');

        $this->assertViewHas('users');
    }

    public function testDataExists()
    {
        $user = factory(App\User::class, 1)->create();

        $this->visit('/users')
            ->see($user->name);
    }
}
