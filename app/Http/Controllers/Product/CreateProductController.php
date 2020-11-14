<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Str;

class CreateProductController extends Controller
{
    public function store(Request $request)
    {
        $imageFile = $request->file('image');
        $imageName = Str::random(10);
        $savedImageUrl = \Storage::putFileAs('images', $imageFile, $imageName.'.'.$imageFile->extension());

        $product = Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => env('APP_URL').'/'.$savedImageUrl,
            'price' => $request->price,
        ]);

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
