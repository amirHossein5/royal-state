<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_index_page_renders()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get(route('dashboard.index'))
            ->assertStatus(200);
    }
}
