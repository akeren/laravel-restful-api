<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DeleteProductController extends Controller
{
    public function destroy($id)
    {
        \Gate::authorize('edit', 'products');

        $product = Product::destroy($id);

        if(!$product) {
            return response([
                'status' => 'fail',
                'code' => 404,
                'message' => 'No product with the associated ID found.',
            ])->setStatusCode(404);
        }

        return response([
            'status' => 'success',
            'code' => 204,
            'message' => 'Product deleted successfully.',
            'data' => null,
        ])->setStatusCode(204);
    }
}
