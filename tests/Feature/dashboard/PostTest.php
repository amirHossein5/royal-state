<?php

namespace Tests\Feature\dashboard;

use App\Models\Post;
use App\Services\ImageService;
use App\Traits\AuthorizableTest;
use Database\Seeders\AssignRolePermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase, AuthorizableTest, WithFaker;

    protected $seeder = AssignRolePermissionsSeeder::class;

    /**
     * test_user_with_post_access_all_can_access_everywhere
     *
     */
    public function test_user_with_post_access_all_can_access_everywhere()
    {
        $this->actWithPermission(['post_view_any', 'post_access_all']);

        $post = $this->createPostWithImage();

        $this->get(route('dashboard.posts.create'))
            ->assertStatus(200);

        $this->get(route('dashboard.posts.edit', $post->slug))
            ->assertStatus(200);

        $this->get(route('dashboard.posts.index'))
            ->assertStatus(200)
            ->assertSee('ویرایش')
            ->assertSee('حذف')
            ->assertSee('ایجاد');

        $this->delete(route('dashboard.posts.destroy', $post->id))
            ->assertRedirect(route('dashboard.posts.index'));

        $this->delete(route('dashboard.posts.forceDelete', $post->id))
            ->assertRedirect(route('dashboard.posts.index'));

        $post = $this->createPostWithImage();

        $this->delete(route('dashboard.posts.destroy', $post->id))
            ->assertRedirect(route('dashboard.posts.index'));

        $this->post(route('dashboard.posts.restore', $post->id))
            ->assertRedirect(route('dashboard.posts.index'));
    }

    /**
     * test_post_creates_and_index_page_shows_correct_posts
     *
     */
    public function test_post_creates_and_index_page_shows_correct_posts()
    {
        $this->actWithPermission(['post_view_any', 'post_create']);

        $this->get(route('dashboard.posts.create'))
            ->assertStatus(200);

        $post = $this->createPostWithImage()->toArray();

        // convert post images ['first_size'=>path,'secnd_size'=>path] to plain path
        $allImages = [];
        $allImages[] = str_replace('storage', 'public', $post['image']['79_80']);
        $allImages[] = str_replace('storage', 'public', $post['image']['730_547']);
        $allImages[] = str_replace('storage', 'public', $post['image']['225_250']);

        Storage::assertExists($allImages);
        ImageService::remove($allImages);

        //compare with database
        $posts = Post::first()->toArray();

        $this->assertEquals($posts['title'], $post['title']);
        $this->assertEquals($posts['body'], $post['body']);
        $this->assertNotNull($posts['image']['79_80']);
        $this->assertNotNull($posts['image']['225_250']);
        $this->assertNotNull($posts['image']['730_547']);
        $this->assertDatabaseCount('posts', 1);
    }

    /**
     * test_post_can_be_deleted_forceDeleted_and_restored
     *
     */
    public function test_post_can_be_deleted_forceDeleted_and_restored()
    {
        $this->actWithPermission([
            'post_view_any',
            'post_create',
            'post_restore',
            'post_force_delete',
            'post_delete',
            'post_view'
        ]);

        $post = $this->createPostWithImage();

        $this->get(route('dashboard.posts.index'))
            ->assertStatus(200)
            ->assertDontSee('ویرایش')
            ->assertSee('حذف')
            ->assertSee('ایجاد');

        $this->delete(route('dashboard.posts.destroy', $post->id))
            ->assertRedirect(route('dashboard.posts.index'));

        $this->delete(route('dashboard.posts.forceDelete', $post->id))
            ->assertRedirect(route('dashboard.posts.index'));

        $post = $this->createPostWithImage();

        $this->delete(route('dashboard.posts.destroy', $post->id))
            ->assertRedirect(route('dashboard.posts.index'));

        $this->post(route('dashboard.posts.restore', $post->id))
            ->assertRedirect(route('dashboard.posts.index'));
    }

    private function createPostWithImage(): object
    {
        $post = Post::factory()
            ->make()
            ->toArray();

        $image = UploadedFile::fake()->image('test.png');
        $post['image'] = $image;

        $this->post(route('dashboard.posts.store'), $post)
            ->assertRedirect(route('dashboard.posts.index'));

        return Post::where('body', $post['body'])->first();
    }
}
