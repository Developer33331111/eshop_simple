<?php

namespace App\Services;

use App\Models\Product;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService {

  public function getProductsPaginate(int $perPage = 10): LengthAwarePaginator {

    $products = Product::query()->latest()->paginate($perPage);

    return $products;

  }

  public function createProduct(array $data): Product {

    $product = Product::create([
      'code' => $data['code'] ?? null,
      'name' => $data['name'],
      'seo_url' => $data['seo_url'] ?? null,
      'price' => $data['price'],
      'description' => $data['description'] ?? null
    ]);

    return $product;

  }

  public function updateProduct(int $id, array $data): Product {

    $product = Product::findOrFail($id);

    $product->update([
      'code' => $data['code'] ?? null,
      'name' => $data['name'],
      'seo_url' => $data['seo_url'] ?? null,
      'price' => $data['price'],
      'description' => $data['description'] ?? null
    ]);

    return $product;

  }


  public function deleteProduct(int $id): bool {

    $product = Product::findOrFail($id);

    return $product->delete();

  }

}
