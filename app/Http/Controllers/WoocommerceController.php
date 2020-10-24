<?php

namespace App\Http\Controllers;
use Woocommerce;

use Illuminate\Http\Request;

class WoocommerceController extends Controller
{
    public function ViewWoocommerce()
    {
    	
    	$orders = Woocommerce::get('orders');
    	dd($orders);
    }
}
