<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    private User $user;
    private TaskStatus $taskStatus;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->data = TaskStatus::factory()->make()->only(['name']);
        $this->taskStatus = TaskStatus::factory()->create();
    }

    public function testTaskStatusesPage(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.index'));

        $response->assertOk();
    }

    public function testStoreTaskStatus(): void
    {
        $response = $this->actingAs($this->user)
            ->post(route('task_statuses.store', $this->data));

        $response->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseHas('task_statuses', $this->data);
    }

    public function testNotCreateStoreTaskStatusWithoutAuthorized(): void
    {
        $response = $this->post(route('task_statuses.store', $this->data));

        $response->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseMissing('task_statuses', $this->data);
    }

    public function testEditPage(): void
    {
        $response = $this->actingAs($this->user)
                        ->get(route('task_statuses.edit', $this->taskStatus));

        $response->assertOk();
    }

    public function testUpdateTaskStatus(): void
    {
        $response = $this->actingAs($this->user)
            ->put(route('task_statuses.update', $this->taskStatus), $this->data);

        $response->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseHas('task_statuses', $this->data);
    }

    public function testNotUpdateTaskStatusWithoutAuthorized(): void
    {
        $response = $this->put(route('task_statuses.update', $this->taskStatus), $this->data);

        $response->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseMissing('task_statuses', $this->data);
    }

    public function testDeleteTaskStatus(): void
    {
        $response = $this->actingAs($this->user)
            ->delete(route('task_statuses.destroy', $this->taskStatus));

        $response->assertRedirect(route('task_statuses.index'));

        $this->assertDatabaseMissing('task_statuses', $this->taskStatus->only(['name']));
    }
}
