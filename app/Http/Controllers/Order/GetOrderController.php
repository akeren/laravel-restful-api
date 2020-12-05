<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class GetOrderController extends Controller
{
    public function show($id)
    {
        \Gate::authorize('view', 'orders');
        
        $order = Order::find($id);

        if(!$order) {
            return response([
                'status' => 'fail',
                'code' => 404,
                'message' => 'Unable to retrieved order.',
            ])->setStatusCode(404);
        }

        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'Data retrieved successfully.',
            'data' => new OrderResource($order),
        ])->setStatusCode(200);
    }
}
