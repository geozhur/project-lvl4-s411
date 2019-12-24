<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Task;
use App\TaskStatus;
use App\User;
use App\Tag;

class TaskControllerTest extends TestCase
{
    use WithFaker;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->actingAs($this->user);
    }

    public function testIndex()
    {
        $task = factory(Task::class)->create();
        $task->creator_id = $this->user->id;
        $response = $this->get(route('tasks.edit', $task->id));

        $response->assertStatus(200)
            ->assertSee($task->name);
    }

    public function testUpdateTask()
    {
        $task = factory(Task::class)->create(['creator_id' => $this->user->id]);
        $task->name = "Updated Title";
        $this->patch(route('tasks.update', $task->id), $task->toArray());

        $task2 = Task::find($task->id);
        $this->assertEquals($task->name, $task2->name);
    }

    public function testStore()
    {
        $task = factory(Task::class)->make();
        $this->post(route('tasks.store'), $task->toArray());
        $task2 = Task::where('name', $task->name)->first();
        $this->assertEquals($task->name, $task2->name);
    }

    public function testDestroyTask()
    {
        $task = factory(Task::class)->create();
        $response = $this->delete(route('tasks.destroy', $task->id));
        $response->assertStatus(302);
        $task2 = Task::find($task->id);
        $this->assertNull($task2);
    }

    public function testFilterStatus()
    {
        $task = factory(Task::class)->create();
        $data = [
            'status' => $task->status->id,
        ];
        $response = $this->get(route('tasks.index', $data));
        $response->assertStatus(200)->assertSee($task->name);
    }

    public function testFilterAssignedTo()
    {
        $task = factory(Task::class)->create();
        $data = [
            'assignedto' => $task->assignedTo->id,
        ];
        $response = $this->get(route('tasks.index', $data));
        $response->assertStatus(200)->assertSee($task->name);
    }

    public function testFilterTag()
    {
        $task = factory(Task::class)->create();
        $tag = factory(Tag::class)->create();
        $task->tag()->sync($tag);

        $data = [
            'tag' => $tag->name,
        ];
        $response = $this->get(route('tasks.index', $data));
        $response->assertStatus(200)->assertSee($task->name);
    }

    public function testFilterMyTasks()
    {
        $task = factory(Task::class)->make();
        $this->post(route('tasks.store'), $task->toArray());
        $data = [
            'mytasks' => 1,
        ];

        $user2 = factory(User::class)->create();
        $this->actingAs($user2);
        $task2 = factory(Task::class)->make();
        $this->post(route('tasks.store'), $task2->toArray());

        $response = $this->actingAs($user2)->get(route('tasks.index', $data));
        $response->assertStatus(200)
            ->assertSee($task2->name)
            ->assertDontSee($task->name);
    }
}
