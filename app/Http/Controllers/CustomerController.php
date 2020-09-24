<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerlogin()
    {
        return view('customers.customers-login');
    }
}
