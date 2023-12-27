<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function route;

class LabelControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $label = Label::factory()->make()->toArray();
        $response = $this->actingAs($this->user)->post(route('labels.store'), $label);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', $label);
    }

    public function testEdit(): void
    {
        $label = Label::factory()->create();
        $response = $this->actingAs($this->user)->get(route('labels.edit', [$label]));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $label = Label::factory()->create();
        $labelData = $label->only(['name', 'description']);
        $response = $this->actingAs($this->user)->patch(route('labels.update', $label), $labelData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', $labelData);
    }

    public function testDestroy(): void
    {
        $label = Label::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', [$label]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }
}
