<?php

namespace Tests\Feature\dashboard;

use App\Traits\AuthorizableTest;
use Database\Seeders\AssignRolePermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SlideTest extends TestCase
{
    use RefreshDatabase, AuthorizableTest;

    protected $seeder = AssignRolePermissionsSeeder::class;

    /**
     * test_slides_index_page_renders_and_shows_proper_data
     *
     */
    public function test_slides_index_page_renders()
    {
        $this->actWithPermission([
            'slide_view_any',
        ]);

        $this->get(route('dashboard.slides.index'))
            ->assertStatus(200);
    }

    /**
     * test_slides_index_page_renders_and_shows_proper_data
     *
     */
    public function test_slide_creates()
    {
        $this->actWithPermission([
            'slide_view_any',
            'slide_create',
            'advertise_view_any',
            'advertise_create'
        ]);

        //create article
        $advertise = [];

        $this->get(route('dashboard.slides.create'))
            ->assertStatus(200);

        $this->post(route('dashboard.slides.store',$advertise->id))
            ->assertRedirect(route('dashboard.slides.index'));
    }
}
