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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
