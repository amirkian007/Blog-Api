<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_can_login_with_true_credentials()
    {
        $user = User::factory()->create();
        $response = $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => $user->password,
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
    }
}
