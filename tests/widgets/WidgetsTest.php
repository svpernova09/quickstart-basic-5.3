<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WidgetsTest extends TestCase
{
    use DatabaseTransactions;

    public function testWidgetsRoute()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/widgets')
            ->see('Widgets Index');

        $this->assertResponseOk();
    }

    public function testWidgetsNavigation()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->click('Widgets')
            ->seePageIs('/widgets');
    }

    public function testWidgetsViewHasData()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/widgets')
            ->seePageIs('/widgets');

        $this->assertViewHas('widgets');
    }

    public function testDataExists()
    {
        $widget = factory(App\Widget::class, 1)->create();
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/widgets')
            ->see($widget->name);
    }
}
