<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class UserTest extends TestCase
{

    use RefreshDatabase, WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_guess_user_can_see_posts()
    {
        $posts = Post::factory(2)->create();
        $this->getJson(route('post.index'))->assertUnauthorized();
    }

    public function test_only_auth_user_can_create_post()
    {
        $user = User::factory()->create();
        $post = Post::factory()->raw();
        $response = $this->actingAs($user)->postJson(route('post.store'), $post);
        $post['user_id'] = auth()->user()->id;
        $this->assertDatabaseHas('posts',$post);
    }
}
