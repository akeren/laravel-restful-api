<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class GetProductController extends Controller
{
    public function show($id)
    {
        \Gate::authorize('view', 'products');

        $product = Product::find($id);

        if(!$product) {
            return response([
                'status' => 'fail',
                'code' => 404,
                'message' => 'No product with the associated ID found.',
            ])->setStatusCode(404);
        }

        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'Data retrieved successfully.',
            'data' => new ProductResource($product),
        ])->setStatusCode(200);
    }
}
