<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginRedirectTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_is_redirected_to_dashboard_after_successful_login(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'secret123',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret123',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($user);
    }
}
