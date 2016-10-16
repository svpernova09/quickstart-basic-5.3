<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksTest extends TestCase
{
    use DatabaseTransactions;

    public function testTasksRoute()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/tasks')
            ->see('Tasks Index');

        $this->assertResponseOk();
    }

    public function testTasksNavigation()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->click('Tasks')
            ->seePageIs('/tasks');
    }

    public function testTasksViewHasData()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/tasks')
            ->seePageIs('/tasks');

        $this->assertViewHas('tasks');
    }

    public function testDataExists()
    {
        $task = factory(App\Task::class, 1)->create();
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/tasks')
            ->see($task->name);
    }
}
