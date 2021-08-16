<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_index_page_renders()
    {
        $response = $this->get(route('dashboard.index'));

        $response->assertStatus(200);
    }
}
