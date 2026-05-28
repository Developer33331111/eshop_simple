<?php

namespace App\Services;

use App\Models\Product;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductService {

  public function getProductsPaginate(int $perPage = 10): LengthAwarePaginator {

    $products = Product::query()->with('parameters')->latest()->paginate($perPage);

    return $products;

  }

  public function createProduct(array $data): Product {

    if(!empty($data['image'])) {

      $data['image'] = $this->storeImage($data['image']);

    }

    $product = Product::create([
      'code' => $data['code'] ?? null,
      'name' => $data['name'],
      'seo_url' => $data['seo_url'] ?? null,
      'price' => $data['price'],
      'description' => $data['description'] ?? null,
      'image' => $data['image'] ?? null
    ]);

    if( !empty($data['parameters']) ) {

      $product->parameters()->createMany($data['parameters']);

    }

    return $product->load('parameters');

  }

  public function updateProduct(int $id, array $data): Product {

    $product = Product::findOrFail($id);

    if(!empty($data['image'])) {

      $this->deleteImage($product->image);

      $data['image'] = $this->storeImage($data['image']);

    }

    $product->update([
      'code' => $data['code'] ?? null,
      'name' => $data['name'],
      'seo_url' => $data['seo_url'] ?? null,
      'price' => $data['price'],
      'description' => $data['description'] ?? null,
      'image' => $data['image'] ?? null
    ]);

    $product->parameters()->delete();

    if( !empty($data['parameters']) ) {

      $product->parameters()->createMany($data['parameters']);

    }

    return $product->load('parameters');

  }

  private function storeImage(UploadedFile $file): string {

    return $file->store('products_images', 'public');

  }

  public function deleteProduct(int $id): bool {

    $product = Product::findOrFail($id);

    return $product->delete();

  }

  private function deleteImage(?string $path): void {

    if($path && Storage::disk('public')->exists($path)) {

      Storage::disk('public')->delete($path);

    }

  }

}
