<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Bigcommerce\Api\Client as Bigcommerce;

use Illuminate\Support\Facades\Log;

class CustomersController extends BaseController
{
    public function index()
    {
        Log::info("CustomersController index()");
        $users = $this->getCustomer();
        $orders = Bigcommerce::getOrders();


        $customer_with_order_count = array();
        foreach ($users as $customer) {
            $customer_with_order_count[$customer->id] = 0;
        }

        foreach ($orders as $order) {
            if (array_key_exists($order->customer_id, $customer_with_order_count)) {
                $customer_with_order_count[$order->customer_id] = $customer_with_order_count[$order->customer_id] + 1;
            }
        }

        return view('customers', compact('users', 'customer_with_order_count'));
    }

    /**
     * Add cache for performance.
     * @return array that store all customers
     */
    private function getCustomer()
    {
        return Bigcommerce::getCustomers();
    }
}
