<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;

class ExportOrdersController extends Controller
{
    public function exportOrdersToCSV() 
    {
        \Gate::authorize('view', 'orders');
        
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=orders.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () {
            $orders = Order::all();

            // Open a file with a write permission
            $file = fopen('php://output', 'w');

            // Create a Header row in the CSV file 
            fputcsv($file, ['ID', 'Name', 'Email', 'Product Title', 'Price', 'Quantity']);

            // Body of the CSV
            foreach($orders as $order) {
                fputcsv($file, [$order->id, $order->name, $order->email, '', '', '']);
                foreach($order->orderItems as $orderItem) {
                    fputcsv($file, ['', '', '', $orderItem->proudct_title, $orderItem->price, $orderItem->quantity]);
                }
            }

            // Close the file 
            fclose($file);

        };

        return \Response::stream($callback, 200, $headers);
    }
}
