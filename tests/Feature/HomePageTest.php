<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function testHomePageIsAccessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
