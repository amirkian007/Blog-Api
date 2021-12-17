<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
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
}
