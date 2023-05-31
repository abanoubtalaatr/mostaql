<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testLogin()
    {
        $user = factory(User::class)->create([
            'username' => 'testuser',
            'password' => Hash::make('password'),
        ]);

        $response = $this->json('POST', '/api/login', [
            'username' => 'testuser',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Login successful',
            ]);

        $this->assertAuthenticatedAs($user);
    }
}
