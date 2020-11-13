<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DeleteProductController extends Controller
{
    public function destroy($id)
    {
        $product = Product::destroy($id);

        return response([
            'status' => 'success',
            'code' => 204,
            'message' => 'Product deleted successfully.',
            'data' => null,
        ])->setStatusCode(204);
    }
}
