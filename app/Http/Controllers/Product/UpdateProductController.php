<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateProductController extends Controller
{
    public function update(Request $request,$id)
    {
        \Gate::authorize('edit', 'products');

        $product = Product::find($id);

        if(!$product) {
            return response([
                'status' => 'fail',
                'code' => 404,
                'message' => 'No product with the associated ID found.',
            ])->setStatusCode(404);
        }
        
        if(!$product->update($request->only('title', 'description', 'image', 'price'))) {
            return response([
                'status' => 'fail',
                'code' => 304,
                'message' => 'Unable update records. Try again!',
            ])->setStatusCode(Response::HTTP_NOT_MODIFIED);
        }

        return response([
            'status' => 'success',
            'code' => 202,
            'message' => 'Changes made successfully.',
            'data' => new ProductResource($product),
        ])->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
