<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use App\Http\Requests\StoreProductRequest;

class ProductsController extends Controller
{

    public function __construct(private ProductService $productService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

      $products = $this->productService->getProductsPaginate(perPage: $request->integer('per_page', 30));

      return ProductResource::collection($products);

    }

    public function store(StoreProductRequest $request)
    {

      $product = $this->productService->createProduct($request->validated());

      return response()->json([
        'data' => [
          'product' => new ProductResource($product)
        ]
      ], 201);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, string $id)
    {

      $product = $this->productService->updateProduct($id, $request->validated());

      return response()->json([
        'data' => [
          'product' => new ProductResource($product)
        ]
      ], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
