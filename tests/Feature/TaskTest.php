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
            ->withSession(['banned' => false])
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
            ->withSession(['banned' => false])
            ->post(route('tasks.store', $data));

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testNotCreateStoreTaskWithoutAuthorized(): void
    {
        $data = Task::factory()->make()->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id',
        ]);
        $response = $this->post(route('tasks.store', $data));

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', $data);
    }

    public function testEditPage(): void
    {
        $response = $this->actingAs($this->user)
                        ->withSession(['banned' => false])
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
            ->withSession(['banned' => false])
            ->put(route('tasks.update', $this->task), $data);

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testNotUpdateTaskWithoutAuthorized(): void
    {
        $data = Task::factory()->make()->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id',
        ]);

        $response = $this->put(route('tasks.update', $this->task), $data);

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', $data);
    }

    public function testDeleteTask(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->delete(route('tasks.destroy', $this->task));

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', $this->data);
    }

    public function testNotDeleteTaskWithoutCreater(): void
    {
        $responseUser = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->post(route('tasks.store', $this->data));

        $user2 = User::factory()->create();
        $responseUser2 = $this->actingAs($user2)
            ->withSession(['banned' => false])
            ->delete(route('tasks.destroy', $this->task));


        $responseUser2->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', $this->data);
    }

    public function testNotCreateTaskUnauthorized(): void
    {
        $response = $this->get(route('tasks.create'));

        $response->assertStatus(403);
    }

    public function testNotEditTaskUnauthorized(): void
    {
        $response = $this->get(route('tasks.edit', $this->task));

        $response->assertStatus(403);
    }
}
