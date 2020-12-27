<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DeleteProductController extends Controller
{
    public function destroy(Product $product)
    {
        \Gate::authorize('edit', 'products');

        $product->delete();

        return response([
            'status' => 'success',
            'code' => 204,
            'message' => 'Product deleted successfully.',
            'data' => null,
        ])->setStatusCode(204);
    }
}
