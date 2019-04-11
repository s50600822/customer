<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class CustomerDetailsController extends BaseController
{
    public function show($id)
    {
        return view('details', [
            'customer' => null,
            'lifeTimeValue' => 100,
        ]);
    }
}
