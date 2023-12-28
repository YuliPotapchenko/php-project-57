<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelTest extends TestCase
{
    private User $user;
    private Label $label;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->data = Label::factory()->make()->only(['name', 'description']);
        $this->label = Label::factory()->create();
    }

    public function testLabelsPage(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->get(route('labels.index'));

        $response->assertOk();
    }

    public function testStoreLabel(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->post(route('labels.store', $this->data));

        $response->assertRedirect(route('labels.index'));

        $this->assertDatabaseHas('labels', $this->data);
    }

    public function testNotStoreLabelWithoutAuthorized(): void
    {
        $response = $this->post(route('labels.store', $this->data));

        $response->assertRedirect(route('labels.index'));

        $this->assertDatabaseMissing('labels', $this->data);
    }

    public function testEditPageLabel(): void
    {
        $response = $this->actingAs($this->user)
                        ->withSession(['banned' => false])
                        ->get(route('labels.edit', $this->label));

        $response->assertOk();
    }

    public function testUpdateLabel(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->put(route('labels.update', $this->label), $this->data);

        $response->assertRedirect(route('labels.index'));

        $this->assertDatabaseHas('labels', $this->data);
    }

    public function testNotUpdateLabelWithoutAuthorized(): void
    {
        $response = $this->put(route('labels.update', $this->label), $this->data);

        $response->assertRedirect(route('labels.index'));

        $this->assertDatabaseMissing('labels', $this->data);
    }

    public function testDeleteLabel(): void
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->delete(route('labels.destroy', $this->label));

        $response->assertRedirect(route('labels.index'));

        $this->assertDatabaseMissing('labels', $this->label->only(['name', 'description']));
    }

    public function testNotCreatePageLabelUnauthorized(): void
    {
        $response = $this->get(route('labels.create'));

        $response->assertStatus(403);
    }
}
