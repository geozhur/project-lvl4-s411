<?php

namespace Tests\Feature;

use App\TaskStatus;
use App\User;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->actingAs($this->user);
    }

    public function testIndex()
    {
        $status = factory(TaskStatus::class)->create();
        $response = $this->get(route('taskstatuses.edit', $status->id));

        $response->assertStatus(200)
            ->assertSee($status->name);
    }

    public function testUpdateName()
    {
        $status = factory(TaskStatus::class)->create();
        $this->patch(route('taskstatuses.update', $status->id), [
            'name' => 'Claus',
        ]);

        $status2 = TaskStatus::find($status->id);
        $this->assertEquals('Claus', $status2->name);
    }

    public function testStoreName()
    {
        $data = [
            'name' => 'Claus',
        ];
        $this->post(route('taskstatuses.store'), $data);
        $status2 = TaskStatus::where('name', $data['name'])->first();
        $this->assertEquals($data['name'], $status2->name);
    }

    public function testDestroyTaskStatus()
    {
        $status = factory(TaskStatus::class)->create();
        $response = $this->delete(route('taskstatuses.destroy',  $status->id));
        $response->assertStatus(302);
        $status2 = TaskStatus::find($status->id);
        $this->assertNull($status2);
    }
}
