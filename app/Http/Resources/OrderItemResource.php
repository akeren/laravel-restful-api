<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'orderId' => $this->order_id,
            'productTitle' => $this->proudct_title,
            'price' => (float) $this->price,
            'quantity' => (int) $this->quantity,
        ];
    }
}
