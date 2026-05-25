<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

use App\Models\User;
use App\Models\Product;
use Database\Seeders\RoleSeeder;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    public function test_get_products(): void
    {

      $this->seed(RoleSeeder::class);

      $user = User::factory()->create();

      $user->assignRole('User');

      Sanctum::actingAs($user);

      $product = Product::factory()->create();

      $response = $this->getJson('/api/products');

      $response->assertStatus(200)
               ->assertJsonStructure([
                 'data' => [
                 '*' => [
                   'code',
                   'name',
                   'seo_url',
                   'price',
                   'description'
                 ]
                ]
              ])
              ->assertJsonFragment([
                'name' => $product->name
              ]);

    }

    public function test_post_products(): void
    {

      $this->seed(RoleSeeder::class);

      $user = User::factory()->create();

      $user->assignRole('Admin');

      Sanctum::actingAs($user);

      $payload = [
        'code' => 'PRD-1234',
        'name' => 'Product Test',
        'seo_url' => 'product_test',
        'price' => 100,
        'description' => 'Description'
      ];

      $response = $this->postJson('/api/products', $payload);

      $response->assertStatus(201);

      $this->assertDatabaseHas('products', [
        'name' => 'Product Test',
        'price' => 100,
      ]);

    }

    public function test_put_products(): void
    {

      $this->seed(RoleSeeder::class);

      $user = User::factory()->create();

      $user->assignRole('Admin');

      Sanctum::actingAs($user);

      $product = Product::factory()->create();

      $payload = [
        'code' => 'PRD-1234',
        'name' => 'Product Test',
        'seo_url' => 'product_test',
        'price' => 100,
        'description' => 'Description'
      ];

      $response = $this->putJson('/api/products/'.$product->id, $payload);

      $response->assertStatus(201);

      $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Product Test',
        'price' => 100,
      ]);

    }

    public function test_delete_products(): void
    {

      $this->seed(RoleSeeder::class);

      $user = User::factory()->create();

      $user->assignRole('Admin');

      Sanctum::actingAs($user);

      $product = Product::factory()->create();

      $response = $this->deleteJson('/api/products/'.$product->id);

      $response->assertStatus(200);

      $this->assertDatabaseMissing('products', [
        'id' => $product->id
      ]);

    }

}
