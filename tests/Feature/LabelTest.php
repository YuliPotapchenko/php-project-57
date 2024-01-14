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
        $response = $this->get(route('labels.index'));

        $response->assertStatus(200);
    }

    public function testStoreLabel(): void
    {
        $response = $this->post(route('labels.store', $this->data));

        $response->assertRedirect(route('labels.index'));

        $this->assertDatabaseHas('labels', $this->data);
    }

    public function testEditPageLabel(): void
    {
        $response = $this->get(route('labels.edit', $this->label));

        $response->assertStatus(200);
    }

    public function testUpdateLabel(): void
    {
        $response = $this->put(route('labels.update', $this->label), $this->data);

        $response->assertRedirect(route('labels.index'));

        $this->assertDatabaseHas('labels', $this->data);
    }

    public function testDeleteLabel(): void
    {
        $response = $this->delete(route('labels.destroy', $this->label));

        $response->assertRedirect(route('labels.index'));

        $this->assertDatabaseMissing('labels', $this->label->only(['name', 'description']));
    }
}
