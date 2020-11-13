<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class GetAllProductsController extends Controller
{
    public function index()
    {
        $products = Product::paginate();

        return ProductResource::collection($products);
    }
}
