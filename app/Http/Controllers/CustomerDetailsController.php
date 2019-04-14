<?php

namespace App\Http\Controllers;

use Bigcommerce\Api\Client as Bigcommerce;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class CustomerDetailsController extends BaseController
{
    public function show($id)
    {
        Log::debug("CustomerDetailsController show()");

        $customer = $this->getCustomer($id);
        if (!$customer) {
            Log::error("Can not find customer id {$id}");
            return $this->showError();
        }
        return $this->showDetail($customer);
    }

    private function showError(){
        $error_msg = $this->getErrorMsg();
        return view('details', compact('error_msg'));
    }

    private function showDetail($customer){
        $customer_orders = $this->getOrderHistory($customer->id);
        $lifetime_value = $this->getLifeTimeValue($customer_orders);
        return view('details', compact("customer", "lifetime_value", "customer_orders"));
    }

    /**
     *  service call round trip, add cache for performance ?
     */
    private function getCustomer($id)
    {
        // not sure the syntax of filtering, should not have to getAll
        //return Bigcommerce::getCustomers(array("id"=>$id));
        $customers = Bigcommerce::getCustomers();
        $customer_idx = array_search($id, array_column($customers, 'id'));
        if ($customer_idx) {
            return $customers[$customer_idx];
        } else return $customer_idx;
    }

    private function getLifeTimeValue($customer_orders)
    {
        $lifeTimeValue = 0;
        foreach ($customer_orders as $order) {
            $lifeTimeValue = $lifeTimeValue + $order['total'];
        }
        return $lifeTimeValue;
    }

    /**
     *  service call round trip, add cache for performance ?
     */
    private function getOrderHistory($customer_id)
    {
        $orders = Bigcommerce::getOrders();
        $customer_orders = array();
        foreach ($orders as $order) {
            if ($order->customer_id == $customer_id) {
                $entry = array(
                    'date' => $order->date_created,
                    'no_of_product' => $order->items_total,
                    'total' => $order->total_inc_tax
                );
                array_push($customer_orders, $entry);
            }
        }
        return $customer_orders;
    }


    /**
     * a general error message for security OR detail err message for clarification.
     */
    private function getErrorMsg()
    {
        return "Something went wrong, please check application log for more detail.";
    }
}
