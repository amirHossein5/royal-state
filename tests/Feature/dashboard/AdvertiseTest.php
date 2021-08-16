<?php

namespace Tests\Feature\dashboard;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdvertiseTest extends TestCase
{
    public function test_advertises_index_page_renders()
    {
        $response = $this->get(route('dashboard.advertises.index'));

        $response->assertStatus(200);
    }
}
