<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    public function test_login(): void
    {

        $user = User::factory()->create([
          'password' => Hash::make('password123')
        ]);

        $response = $this->postJson('api/login', [
          'email' => $user->email,
          'password' => 'password123'
        ]);

        $response->assertOk()
                 ->assertJsonStructure([
                   'data' => [
                   'token',
                   'user'
                  ]
                ]);

    }
}
