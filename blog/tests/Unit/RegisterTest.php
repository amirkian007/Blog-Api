<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_can_register()
    {
        $user = [
            'name' => 'bgn',
            'email' => 'baghban.b@gmail.com',
            'password' => '123456789',
        ];
        $this->postJson(route('register'), $user);
        $this->assertDatabaseHas('users', [
            'email' => $user['email'],
        ]);
    }


}
