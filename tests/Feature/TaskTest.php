<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    private User $user;
    private Task $task;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        TaskStatus::factory()->create();
        $this->task = Task::factory()->create();
        $this->data = $this->task->only(
            [
                'name',
                'description',
                'status_id',
                'assigned_to_id',
            ]
        );
    }

    public function testTasksPage(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('tasks.index'));

        $response->assertOk();
    }

    public function testStoreTask(): void
    {
        $data = Task::factory()->make()->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id',
        ]);
        $response = $this->actingAs($this->user)
            ->post(route('tasks.store', $data));

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testEditPage(): void
    {
        $response = $this->actingAs($this->user)
                        ->get(route('tasks.edit', $this->task));

        $response->assertOk();
    }

    public function testUpdateTask(): void
    {
        $data = Task::factory()->make()->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id',
        ]);
        $response = $this->actingAs($this->user)
            ->put(route('tasks.update', $this->task), $data);

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testDeleteTask(): void
    {
        $response = $this->actingAs($this->user)
            ->delete(route('tasks.destroy', $this->task));

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', $this->data);
    }
}
