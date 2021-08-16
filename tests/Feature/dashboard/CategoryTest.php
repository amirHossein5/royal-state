<?php

namespace Tests\Feature\dashboard;

use App\Models\Category;
use App\Models\User;
use Database\Seeders\AssignRolePermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected $seeder = AssignRolePermissionsSeeder::class;

    /**
     * test_index_page_shows_correct_categories
     *
     */
    public function test_index_page_shows_correct_categories()
    {
        $this->actWithPermission('category_view_any');

        $first = Category::create(['name' => 'first category']);
        $second = Category::create(['name' => 'second category', 'parent_id' => $first->id]);

        $first =  $first->toArray() + [
            "deleted_at" => null,
            "parent_name" => null,
            "parent_id" => null
        ];

        $second = $second->toArray() + [
            "deleted_at" => null,
            "parent_name" => "first category"
        ];

        $categories = Category::query()
            ->withTrashed()
            ->withParent()
            ->latest()
            ->paginate(10);

        $this->assertCount(2, $categories);
        $this->assertEquals($first, $categories[0]->toArray());
        $this->assertEquals($second, $categories[1]->toArray());

        $this->assertEquals(null, $categories[0]->parent_name);
        $this->assertEquals('first category', $categories[1]->parent_name);

        $response = $this->get(route('dashboard.categories.index'));
        $response->assertStatus(200);
        $response->assertSee(['first category', 'second category', 'دسته اصلی']);
    }

    /**
     * test_user_can_create_category
     *
     */
    public function test_user_can_create_category()
    {
        $this->withoutExceptionHandling();


        $this->actWithPermission('category_create');

        $response = $this->get(route('dashboard.categories.create'));
        $response->assertStatus(200);

        //create without parent
        $response = $this->post(route('dashboard.categories.store', ['name' => 'test parent']));
        $response->assertRedirect(route('dashboard.categories.index'));
        $this->assertDatabaseCount('categories', 1);

        // create with parent
        $category = Category::first()->id;
        $response = $this->post(route('dashboard.categories.store', ['name' => 'test new', 'parent_id' => $category]));
        $response->assertRedirect(route('dashboard.categories.index'));

        $response = $this->get(route('dashboard.categories.index'));
        $response->assertSee(['test parent', 'test new', 'دسته اصلی']);
    }

    /**
     * test_user_can_update_category
     *
     */
    public function test_user_can_update_category()
    {
        $this->actWithPermission('category_update');

        $firstCategory = Category::create(['name' => 'category without update1']);
        $secondCategory = Category::create(['name' => 'category without update2']);

        $response = $this->get(route('dashboard.categories.edit', $firstCategory->id));
        $response->assertStatus(200);

        $response = $this->put(route('dashboard.categories.update', $firstCategory->id), [
            'name' => 'category updated1',
            'parent_id' => $secondCategory->id
        ]);
        $response->assertRedirect(route('dashboard.categories.index'));

        $response = $this->put(route('dashboard.categories.update', $secondCategory->id), ['name' => 'category updated2']);
        $response->assertRedirect(route('dashboard.categories.index'));

        $response  = $this->get(route('dashboard.categories.index'));
        $response->assertSee(['category updated1', 'category updated2', 'دسته اصلی']);
        $response->assertDontSee(['category without update1', 'category without update2']);
    }

    /**
     * test_user_can_delete_category
     *
     */
    public function test_user_can_delete_category()
    {
        $this->actWithPermission('category_delete');

        $category = Category::create(['name' => 'exists']);

        $response = $this->get(route('dashboard.categories.index'));
        $response->assertStatus(200);
        $response->assertSee('exists');

        $response = $this->delete(route('dashboard.categories.destroy', $category->id));
        $response->assertRedirect(route('dashboard.categories.index'));

        $this->assertSoftDeleted($category);
    }

    /**
     * test_user_can_restore_category
     *
     */
    public function test_user_can_restore_category()
    {
        $this->actWithPermission('category_restore');

        $category = Category::create(['name' => 'test']);
        $category->delete();
        $this->assertSoftDeleted($category);

        $response = $this->post(route('dashboard.categories.restore', $category->id));
        $response->assertRedirect();

        $this->assertDatabaseMissing('categories', [
            'deleted_at' => $category->deleted_at
        ]);
    }

    /**
     * test_user_can_force_delete_category
     *
     */
    public function test_user_can_force_delete_category()
    {
        $this->actWithPermission('category_force_delete');

        $category = Category::create(['name' => 'test']);
        $category->delete();
        $this->assertSoftDeleted($category);

        $response = $this->delete(route('dashboard.categories.forceDelete', $category->id));
        $response->assertRedirect();

        $this->assertDatabaseCount('categories', 0);
    }

    public function actWithPermission(string $permission): User
    {
        $user = User::factory()->create();
        $user->addPermission($permission);
        $this->actingAs($user);

        return $user;
    }
}
