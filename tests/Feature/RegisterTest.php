<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Database\Seeders\RoleSeeder;

class RegisterTest extends TestCase
{

    use RefreshDatabase;

    public function test_register(): void
    {

        $this->seed(RoleSeeder::class);

        $user = User::factory()->create([
          'password' => Hash::make('password123')
        ]);

        $response = $this->postJson('api/register', [
          'name' => 'Test user',
          'email' => 'testuser@123laravel123.com',
          'password' => 'password123',
          'password_confirmation' => 'password123'
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
