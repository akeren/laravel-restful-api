<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class GetProductController extends Controller
{
    public function show(Product $product)
    {
        \Gate::authorize('view', 'products');

        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'Data retrieved successfully.',
            'data' => new ProductResource($product),
        ])->setStatusCode(200);
    }
}
