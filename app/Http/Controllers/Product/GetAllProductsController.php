<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Spatie\QueryBuilder\QueryBuilder;

class GetAllProductsController extends Controller
{
    public function index()
    {
        \Gate::authorize('view', 'products');

        $products = QueryBuilder::for(Product::class)
        ->allowedFilters(['title', 'price'])
        ->latest()
        ->jsonPaginate()
        ->appends(request()->query());
        
        return ProductResource::collection($products);
    }
}
