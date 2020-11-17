<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Str;

class CreateProductController extends Controller
{
    public function store(CreateProductRequest $request)
    {
       \Gate::authorize('edit', 'products');
       
        $product = Product::create($request->only('title', 'description', 'image', 'price'));

        if(!$product) {
            return response([
                'status' => 'fail',
                'code' => 400,
                'message' => 'Unable to create product. Try again!',
            ])->setStatusCode(400);
        }

        return response([
            'status' => 'success',
            'code' => 201,
            'message' => 'Product create successfully.',
            'data' => new ProductResource($product),
        ])->setStatusCode(201);
    }
}
