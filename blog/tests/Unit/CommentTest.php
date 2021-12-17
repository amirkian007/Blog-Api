<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_auth_user_can_create_comments()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory()->raw(['post_id' => $post->id, 'user_id' => $user->id]);
        $this->actingAs($user)->postJson(route('comment.store', ['post' => $post]), $comment);
        $this->assertDatabaseHas('comments', $comment);
    }

    public function test_auth_user_can_see_comments()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $comment = Comment::factory(2)->create(['post_id' => $post->id, 'user_id' => $user->id]);
        $response = $this->actingAs($user)->postJson(route('comment.show', $post));
        $response->assertJsonCount(2);
        $this->assertDatabaseCount('comments', 2);
    }
}
