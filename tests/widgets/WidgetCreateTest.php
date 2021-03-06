<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WidgetCreateTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRouteWorks()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/widgets/add')
            ->see('Add Widget');

        $this->assertResponseOk();
    }

    public function testFormSubmitWorks()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/widgets/add')
            ->type('Test Widget', 'name')
            ->type('Great Widget', 'description')
            ->type('49.99', 'price')
            ->press('Add Widget')
            ->seePageIs('/widgets')
            ->seeInDatabase('widgets', [
                'name' => 'Test Widget',
                'description' => 'Great Widget',
                'price' => '49.99',
            ]);
    }

    public function testFormValidation()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/widgets/add')
            ->type('Great Widget', 'description')
            ->type('49.99', 'price')
            ->press('Add Widget')
            ->seePageIs('/widgets/add');
    }
}
