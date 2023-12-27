<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        TaskStatus::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $factoryData = Task::factory()->make()->toArray();
        $task = Arr::only($factoryData, ['name', 'description']);
        $response = $this->actingAs($this->user)->post(route('tasks.store'), $factoryData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $task);
    }

    public function testShow(): void
    {
        $task = Task::factory()->create();
        $response = $this->get(route('tasks.show', [$task]));
        $response->assertOk();
    }

    public function testEdit(): void
    {
        $task = Task::factory()->create();
        $response = $this->actingAs($this->user)->get(route('tasks.edit', [$task]));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $task = Task::factory()->create();
        $taskData = $task->only(['name', 'description', 'status_id']);
        $response = $this->actingAs($this->user)->patch(route('tasks.update', $task), $taskData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $taskData);
    }

    public function testDestroy(): void
    {
        $task = Task::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', [$task]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
