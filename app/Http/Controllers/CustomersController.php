<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class CustomersController extends BaseController
{
    public function index()
    {
        return view('customers');
    }
}
