<?php

namespace Tests\Feature\dashboard;

use App\Events\CommentCreated;
use App\Listeners\SendEmailCommentCreatedListener;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Notifications\CommentCreatedNotification;
use App\Traits\AuthorizableTest;
use Database\Seeders\AssignRolePermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;


class CommentTest extends TestCase
{
    use RefreshDatabase, AuthorizableTest;

    protected $seed = true;

    /**
     * test_comments_index_page_renders_properly
     *
     */
    public function test_comments_index_page_renders_properly()
    {
        $this->actWithPermission('comment_view_any');

        $this->get(route('dashboard.comments.index'))
            ->assertStatus(200);
    }

    /**
     * test_comment_show_page_shows_correct_data_without_reply_permission
     *
     */
    public function test_comment_show_page_shows_correct_data_without_reply_permission()
    {
        $this->actWithPermission([
            'post_create',
            'post_view_any',
            'comment_view_any',
            'comment_view'
        ]);

        $comment = $this->createComment();

        $this->get(route('dashboard.comments.show', $comment->id))
            ->assertStatus(200)
            ->assertsee($comment->body)
            ->assertSee($comment->user->full_name)
            ->assertDontSee('ایجاد');
    }

    /**
     * test_reply_in_comment
     *
     */
    public function test_reply_in_comment()
    {
        Notification::fake();

        $this->actWithPermission([
            'post_create',
            'post_view_any',
            'comment_view_any',
            'comment_view',
        ]);

        $comment =  $this->createComment();

        $this->actWithPermission([
            'post_create',
            'post_view_any',
            'comment_view_any',
            'comment_view',
            'comment_reply'
        ]);

        $this->assertDatabaseCount('comments', 1);

        Notification::assertNothingSent();

        $this->post(route('dashboard.comments.store', [
            'post_id' => $comment->post_id,
            'parent_id' => $comment->id,
            'comment' => 'test comment'
        ]))->assertRedirect(route('dashboard.comments.index'));

        Notification::assertSentTo(
            $comment->user,
            function (CommentCreatedNotification $notification) use ($comment) {
                return $notification->comment === 'test comment' &&
                    $notification->parentComment === $comment->comment;
            }
        );
    }

    /**
     * test_one_person_can_not_access_to_another_persons_comment_if_dont_have_permission_veiw_all
     *
     */
    public function test_one_person_can_not_access_to_another_persons_comment_if_dont_have_permission_veiw_all()
    {
        $this->actWithPermission([
            'post_create',
            'post_view_any',
            'comment_view_any',
            'comment_view',
        ]);

        $comment = $this->createComment();

        $this->actWithPermission([
            'post_create',
            'post_view_any',
            'comment_view_any',
            'comment_view',
        ]);

        $this->get(route('dashboard.comments.index'))
            ->assertDontSee($comment->approvedStatusMinimal);

        $this->get(route('dashboard.comments.show', $comment->id))
            ->assertForbidden();

        $this->actWithPermission([
            'post_create',
            'post_view_any',
            'comment_view_any',
            'comment_view_all',
        ]);

        $this->get(route('dashboard.comments.index'))
            ->assertSee($comment->approvedStatusMinimal);
    }

    /**
     * test_comments_can_be_approved
     *
     */
    public function test_comments_can_be_approved()
    {
        $this->actWithPermission([
            'post_view_any',
            'post_create',
            'comment_view_any',
            'comment_view',
            'comment_approved'
        ]);

        $comment = $this->createComment();

        $this->get(route('dashboard.comments.index'))
            ->assertStatus(200)
            ->assertSee('غیرفعال')
            ->assertSee(auth()->user()->full_name)
            ->assertSee('تایید');

        $this->assertEquals(0, $comment->approved);

        $this->post(route('dashboard.comments.approved', $comment->id))
            ->assertRedirect(route('dashboard.comments.index'));

        $comment = Comment::find($comment->id);

        $this->assertEquals(1, $comment->approved);

        $this->get(route('dashboard.comments.index'))
            ->assertStatus(200)
            ->assertSee('فعال')
            ->assertSee(auth()->user()->full_name)
            ->assertSee('لغو تایید');
    }

    private function createComment(): Object
    {
        $post = Post::factory()->create(['image' => 'test']);

        $comment = auth()->user()->comments()->create([
            'comment' => 'comment_test',
            'post_id' => $post->id,
            'approved' => 0
        ]);

        $expected = Comment::where('comment', $comment->comment)->first();
        $this->assertNotNull($expected);

        return $comment;
    }
}
