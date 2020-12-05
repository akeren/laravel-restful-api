<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Spatie\QueryBuilder\QueryBuilder;

class GetAllOrdersController extends Controller
{
    public function index()
    {
        \Gate::authorize('view', 'orders');
                
        $orders = QueryBuilder::for(Order::class)
        ->allowedAppends(['total'])
        ->latest()
        ->jsonPaginate()
        ->appends(request()->query());

        return OrderResource::collection($orders);
    }
}
