<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_title_and_body_required_for_creating_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->raw(['body' => null]);
        $response = $this->actingAs($user)->postJson(route('post.store'), $post);
        $post['user_id'] = auth()->user()->id;
        $this->assertDatabaseMissing('posts', $post);
        $response->assertUnprocessable();
    }
}
