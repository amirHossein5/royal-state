<?php

namespace Tests\Feature\dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SlideTest extends TestCase
{
    public function test_slides_index_page_renders()
    {
        $response = $this->get(route('dashboard.slides.index'));

        $response->assertStatus(200);
    }
}
