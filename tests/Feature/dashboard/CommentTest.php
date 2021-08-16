<?php

namespace Tests\Feature\dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    public function test_comments_index_page_renders()
    {
        $response = $this->get(route('dashboard.comments.index'));

        $response->assertStatus(200);
    }
}
