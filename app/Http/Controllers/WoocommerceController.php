<?php

namespace App\Http\Controllers;
use Woocommerce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\WpOrder;
use App\Models\WpOrderDetail;

class WoocommerceController extends Controller
{
    public function ViewWoocommerce()
    {
    	//$woocommerce = new Woocommerce();
    	$wp_orders = Woocommerce::get('orders');

    	$orders = DB::table('wp_orders')->get();
    	//dd($wp_orders);
    	//dd($customers["first_name"]);
    	$wp_order_id = [];
    	foreach ($orders as $value) {
    		$wp_order_id[] .= $value->wp_order_id;
    	}
    	$x = 0;

    	for ($i=0; $i <count($wp_orders) ; $i++) { 
    		
    		if ($wp_orders[$i]["id"] != isset($wp_order_id[$i])) {

    			//$customers = Woocommerce::get('customers/'.$wp_orders[$i]["customer_id"]);
    			$billing = $wp_orders[$i]["billing"];
    			$shipping = $wp_orders[$i]["shipping"];
    			//dd($shipping);
    			$order = new WpOrder();
    			$order->wp_order_id = $wp_orders[$i]["id"];
            	$order->customer_name = $billing["first_name"]." ".$billing["last_name"];
    			$order->customer_email = $billing["email"];
    			$order->customer_cell = $billing["phone"];
    			$order->billing_address = $billing["address_1"].",".$billing["address_2"].",".$billing["city"].",".$billing["postcode"].",".$billing["country"];
    			$order->shipping_address = $shipping["address_1"].",".$shipping["address_2"];
    			$order->city = $shipping["city"];
    			$order->post_code = $shipping["postcode"];
    			$order->country = $shipping["country"];
    			$order->total_amount = $wp_orders[$i]["total"];
    			$order->status = $wp_orders[$i]["status"];
    			$order->save();
    			$order_id = $order->id;

    		for ($y=0; $y <count($wp_orders[$i]["line_items"]) ; $y++) { 
                    
                    $order_detail = new WpOrderDetail();
                    $order_detail->order_id = $order_id;
                    $order_detail->product_id = $wp_orders[$i]["line_items"][$y]["product_id"];
                    $order_detail->product_name = $wp_orders[$i]["line_items"][$y]["name"];
                    $order_detail->sku_number = $wp_orders[$i]["line_items"][$y]["sku"];
                    $order_detail->quantity = $wp_orders[$i]["line_items"][$y]["quantity"];
                    $order_detail->price = $wp_orders[$i]["line_items"][$y]["price"];
                    $order_detail->subtotal_amount = $wp_orders[$i]["line_items"][$y]["subtotal"];
                    $order_detail->tax = $wp_orders[$i]["line_items"][$y]["total_tax"];
                    $order_detail->total_amount = $wp_orders[$i]["line_items"][$y]["total"];
                    $order_detail->save();

                }
                
    		}
    		$x = $x+1;
    	}

    	$db_wp_orders = DB::table('wp_orders')->get();

    	return view('admin.woocommerce.orders.view-orders')->with(compact('db_wp_orders'));

    	
    	
    }
}
