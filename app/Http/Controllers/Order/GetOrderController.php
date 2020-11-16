<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class GetOrderController extends Controller
{
    public function show($id)
    {
        $order = Order::find($id);

        return response([
            'status' => 'success',
            'code' => 200,
            'message' => 'Data retrieved successfully.',
            'data' => new OrderResource($order),
        ])->setStatusCode(200);
    }
}
