<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class GetAllProductsController extends Controller
{
    public function index()
    {
        \Gate::authorize('view', 'products');

        $products = Product::latest()->paginate();

        return ProductResource::collection($products);
    }
}
