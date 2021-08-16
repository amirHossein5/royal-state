<?php

namespace Tests\Feature\dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_users_index_page_renders()
    {
        $response = $this->get(route('dashboard.users.index'));

        $response->assertStatus(200);
    }
}
