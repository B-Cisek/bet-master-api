<?php

namespace Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_register(): void
    {
        $user = User::factory()->make();
        $user = [...$user->getAttributes(), 'password' => $user->getAuthPassword()];

        $response = $this->postJson(route('register'), $user);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['status', 'message', 'user', 'authorisation']);
    }

    public function test_login(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('login'), [
            'username' => $user->username,
            'password' => 'password',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['access_token', 'token_type', 'expires_in', 'user']);
    }

    public function test_logout(): void
    {
        $user = User::factory()->create();

        $token = Auth::login($user);

        $response = $this->postJson(route('logout'), headers: [
            'Authorization' => 'Bearer '.$token,
            'Content-Type' => 'application/json',
        ]);

        $response->assertNoContent();
    }

    public function test_me(): void
    {
        $user = User::factory()->create();

        $token = Auth::login($user);

        $response = $this->postJson(route('me'), headers: [
            'Authorization' => 'Bearer '.$token,
            'Content-Type' => 'application/json',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['id', 'username', 'email', 'firstName', 'lastName']);
    }

    public function test_refresh(): void
    {
        $user = User::factory()->create();

        $token = Auth::login($user);

        $response = $this->postJson(route('refresh'), headers: [
            'Authorization' => 'Bearer '.$token,
            'Content-Type' => 'application/json',
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['access_token', 'token_type', 'expires_in', 'user']);
    }
}
