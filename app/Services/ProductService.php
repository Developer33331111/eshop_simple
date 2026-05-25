<?php

namespace App\Services;

use App\Models\Product;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService {

  public function getProductsPaginate(int $perPage = 10): LengthAwarePaginator {

    $products = Product::query()->latest()->paginate($perPage);

    return $products;

  }

}
