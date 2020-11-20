<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChartResource;
use App\Models\Order;

class ChartOrderController extends Controller
{
    public function chart() 
    {
        \Gate::authorize('view', 'orders');
        
        $orders = Order::query()
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') as date, sum(order_items.quantity*order_items.price) as sum")
        ->groupBy('date')
        ->get();

        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'Data retrieved successfully.',
            'data' => ChartResource::collection($orders),
        ])->setStatusCode(200);
    }
}
