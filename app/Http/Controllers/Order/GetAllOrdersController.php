<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class GetAllOrdersController extends Controller
{
    public function index()
    {
        \Gate::authorize('view', 'orders');
        
        $orders = Order::paginate();

        return OrderResource::collection($orders);
    }
}
