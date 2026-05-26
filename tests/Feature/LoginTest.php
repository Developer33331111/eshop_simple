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
          'password' => 'password123',
          'device_name' => 'unit-test'
        ]);

        $response->assertOk()
                 ->assertJsonStructure([
                   'data' => [
                   'token',
                   'user'
                  ]
                ]);

    }

    public function test_login_invalid_password() {

      $user = User::factory()->create([
        'password' => Hash::make('password123')
      ]);

      $response = $this->postJson('api/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
        'device_name' => 'unit-test'
      ]);

      $response->assertStatus(422);

    }

    public function test_login_unknown_email() {

      $response = $this->postJson('api/login', [
        'email' => 'unknown-email@unknown-email.com',
        'password' => 'password123',
        'device_name' => 'unit-test'
      ]);

      $response->assertStatus(422);

    }

    public function test_login_require_all_fields() {

      $response = $this->postJson('api/login', []);

      $response->assertStatus(422);

      $response->assertJsonValidationErrors(['email', 'password']);

    }

}
