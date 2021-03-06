<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Traits\AuthorizableTest;
use Database\Seeders\AssignRolePermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminRoleTest extends TestCase
{
    use RefreshDatabase, AuthorizableTest;

    protected $seed = true;

    /**
     * test_admin_can_see_every_page
     *
     */
    public function test_admin_can_see_every_page()
    {
        $this->actWithRole(User::ADMIN_ROLE);

        $this->get(route('dashboard.categories.index'))->assertStatus(200);
        $this->get(route('dashboard.posts.index'))->assertStatus(200);
        $this->get(route('dashboard.users.index'))->assertStatus(200);
        $this->get(route('dashboard.slides.index'))->assertStatus(200);
        $this->get(route('dashboard.comments.index'))->assertStatus(200);
        $this->get(route('dashboard.advertises.index'))->assertStatus(200);
        $this->get(route('dashboard.roles.index'))->assertStatus(200);

        $user = User::factory()->create();
        $this->get(route('dashboard.users.permissions.editUserPermissions', $user->id))->assertStatus(200);
    }
}
