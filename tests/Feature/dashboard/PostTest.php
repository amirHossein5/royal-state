<?php

namespace Tests\Feature\dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function test_posts_index_page_renders()
    {
        $response = $this->get(route('dashboard.posts.index'));

        $response->assertStatus(200);
    }
}
