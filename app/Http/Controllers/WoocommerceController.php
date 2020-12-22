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
use App\Models\WpOrderAssign;
use App\Models\User;

class WoocommerceController extends Controller
{
    public function ViewWoocommerce()
    {
    	//$woocommerce = new Woocommerce();
    	$wp_orders = Woocommerce::get('orders');

    	$orders = DB::table('wp_orders')->get();
    	
    	//dd($customers["first_name"]);
    	$wp_order_id = [];
    	foreach ($orders as $value) {
    		$wp_order_id[] .= $value->wp_order_id;
    	}
       //dd($wp_orders,$wp_order_id);
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
                $order->location_status = 1;
                $order->is_assign = 0;
                $order->delivery_status = 15;
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

    	$db_wp_orders = DB::table('wp_orders as o')
        ->join('order_location_status as ols','o.location_status','=','ols.id')
        ->join('purchase_order_status as olss','o.delivery_status','=','olss.id')
        ->select('o.*','ols.name as locatin_name','olss.name as delivery_status')
        ->get();

    	return view('admin.woocommerce.orders.view-orders')->with(compact('db_wp_orders'));

    	
    	
    }

    public function ViewWoocommerceProduction()
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

        $db_wp_orders = DB::table('wp_orders as o')
        ->join('order_location_status as ols','o.location_status','=','ols.id')
        ->join('purchase_order_status as os','o.delivery_status','=','os.id')
        ->select('o.*','ols.name as locatin_name','os.name as delivery_status')
        ->get();
        //dd($db_wp_orders);
        return view('departments.production.woocommerce.orders.view-orders')->with(compact('db_wp_orders'));

        
        
    }

    public function ViewWoocommerceFinance()
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

        $db_wp_orders = DB::table('wp_orders as o')
        ->where(['o.status'=>"completed"])
        ->join('order_location_status as ols','o.location_status','=','ols.id')
        ->join('purchase_order_status as olss','o.delivery_status','=','olss.id')
        ->select('o.*','ols.name as locatin_name','olss.name as delivery_status')
        ->get();
    	

    	return view('departments.finance.woocommerce.orders.view-orders')->with(compact('db_wp_orders'));

    	
    	
    }
    public function ViewWoocommercePacking()
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

        $db_wp_orders = DB::table('wp_orders as o')
        ->where(['o.status'=>"processing"])
        ->where(['o.location_status'=> 3])
        ->join('order_location_status as ols','o.location_status','=','ols.id')
        ->join('purchase_order_status as olss','o.delivery_status','=','olss.id')
        ->select('o.*','ols.name as locatin_name','olss.name as delivery_status')
        ->get();

        return view('departments.packing.woocommerce.orders.view-orders')->with(compact('db_wp_orders'));

        
        
    }

    public function ViewWoocommerceTransport()
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
                $order->location_status = 1;
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

        $db_wp_orders = DB::table('wp_orders as o')
        ->where(['o.status'=>"processing"])
        ->join('order_location_status as ols','o.location_status','=','ols.id')
        ->whereIn('o.location_status', [4,5,6,7])
        ->join('purchase_order_status as olss','o.delivery_status','=','olss.id')
        ->select('o.*','ols.name as locatin_name','olss.name as delivery_status')
        ->get();

        return view('departments.transport.woocommerce.orders.view-orders')->with(compact('db_wp_orders'));
        
    }

    public function editOrderAdmin(Request $request, $id='')
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);

            WpOrder::where(['id'=>$id])->update
                    ([
                        'location_status' => $data['dept_status'],
                    ]);

            return redirect('/admin/view-wp-orders')->with('flash_message_success','Order has been Forwarded Successfully!');
        }
        $sale_order = DB::table('wp_orders')->where(['id'=>$id])->first();

        $order_details = DB::table('wp_order_details')->where(['order_id'=>$id])->get();

        $location_status = DB::table('order_location_status')->whereIn('id',[1,2])->get();
        //dd($order_status);
        $location_dropdown = "";
        foreach ($location_status as $loc_status) {
            if ($loc_status->id == $sale_order->location_status) {
                $location_dropdown .= "<option selected value='".$loc_status->id."'>".$loc_status->name."</option>";
            }
            else{
                $location_dropdown .= "<option value='".$loc_status->id."'>".$loc_status->name."</option>";
            }
        }

        return view('admin.woocommerce.orders.edit-order')->with(compact('sale_order','order_details','location_dropdown'));
    }

    public function updateOrderAdmin(Request $request, $id='')
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);

            $data = [
                    'status' => 'processing'
                ];

                $update =  Woocommerce::put('orders/'.$id, $data);
                dd($update);
            WpOrder::where(['id'=>$id])->update
                    ([
                        'location_status' => $data['order_status'],
                    ]);

            return redirect('/admin/view-wp-orders')->with('flash_message_success','Order has been Forwarded Successfully!');
        }
        $sale_order = DB::table('wp_orders')->where(['wp_order_id'=>$id])->first();

        $order_details = DB::table('wp_order_details')->where(['order_id'=>$sale_order->id])->get();

        $location_status = ["processing","completed","failed","OnHold"];
        //dd($order_status);
        $location_dropdown = "";
        foreach ($location_status as $loc_status) {
            if ($loc_status == $sale_order->status) {
                $location_dropdown .= "<option selected value='".$loc_status."'>".$loc_status."</option>";
            }
            else{
                $location_dropdown .= "<option value='".$loc_status."'>".$loc_status."</option>";
            }
        }

        return view('admin.woocommerce.orders.update-order')->with(compact('sale_order','order_details','location_dropdown'));
    }
    public function editOrderProduction(Request $request, $id='')
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);

            WpOrder::where(['id'=>$id])->update
                    ([
                        'location_status' => $data['dept_status'],
                    ]);

            return redirect('/production/view-wp-orders')->with('flash_message_success','Order has been Forwarded Successfully!');
        }
        $sale_order = DB::table('wp_orders')->where(['id'=>$id])->first();

        $order_details = DB::table('wp_order_details')->where(['order_id'=>$id])->get();

        $location_status = DB::table('order_location_status')->whereIn('id',[2,3])->get();
        //dd($order_status);
        $location_dropdown = "";
        foreach ($location_status as $loc_status) {
            if ($loc_status->id == $sale_order->location_status) {
                $location_dropdown .= "<option selected value='".$loc_status->id."'>".$loc_status->name."</option>";
            }
            else{
                $location_dropdown .= "<option value='".$loc_status->id."'>".$loc_status->name."</option>";
            }
        }

        return view('departments.production.woocommerce.orders.edit-order')->with(compact('sale_order','order_details','location_dropdown'));
    }

    public function editOrderPacking(Request $request, $id='')
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);

            WpOrder::where(['id'=>$id])->update
                    ([
                        'location_status' => $data['dept_status'],
                    ]);

            return redirect('/packing/view-wp-orders')->with('flash_message_success','Order has been Forwarded Successfully!');
        }
        $sale_order = DB::table('wp_orders')->where(['id'=>$id])->first();

        $order_details = DB::table('wp_order_details')->where(['order_id'=>$id])->get();

        $location_status = DB::table('order_location_status')->whereIn('id',[3,4])->get();
        //dd($order_status);
        $location_dropdown = "";
        foreach ($location_status as $loc_status) {
            if ($loc_status->id == $sale_order->location_status) {
                $location_dropdown .= "<option selected value='".$loc_status->id."'>".$loc_status->name."</option>";
            }
            else{
                $location_dropdown .= "<option value='".$loc_status->id."'>".$loc_status->name."</option>";
            }
        }

        return view('departments.packing.woocommerce.orders.edit-order')->with(compact('sale_order','order_details','location_dropdown'));
    }

    public function editOrderTransport(Request $request, $id='')
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);

            WpOrder::where(['id'=>$id])->update
                    ([
                        'location_status' => 6,
                        'delivery_status' => 15,
                        'is_assign' => 1,
                    ]);
            $assign_orders = DB::table('wp_order_assign')
            ->where(['order_id'=> $id])
            ->get();
            if (count($assign_orders) == 0) {
                $assign = new WpOrderAssign();
                $assign->order_id = $id;
                $assign->rider_id = $data["rider"];
                $assign->vehicle_id = $data["vehicle"];
                $assign->save();
            }

            User::where(['id'=>$data["rider"]])->update
            ([
                'is_assign' => 1,
            ]);
            return redirect('/transport/view-wp-orders')->with('flash_message_success','Order has been Forwarded Successfully!');
        }
        $sale_order = DB::table('wp_orders')->where(['id'=>$id])->first();

        $order_details = DB::table('wp_order_details')->where(['order_id'=>$id])->get();

        $location_status = DB::table('order_location_status')->whereIn('id',[6])->get();
        //dd($order_status);
        $location_dropdown = "";
        foreach ($location_status as $loc_status) {
            if ($loc_status->id == $sale_order->location_status) {
                $location_dropdown .= "<option selected value='".$loc_status->id."'>".$loc_status->name."</option>";
            }
            else{
                $location_dropdown .= "<option value='".$loc_status->id."'>".$loc_status->name."</option>";
            }
        }
        $rolename = 10;
        $user_by_roles = User::whereHas('roles', function ($q) use ($rolename) {
            $q->where('id', $rolename);
            })->get();

        $users_dropdown = "<option selected value='0' readonly>Select User</option>";
            foreach ($user_by_roles as $users) {
                $users_dropdown .= "<option value='".$users->id."'>".$users->name . "</option>";
            }
        $vehicles = DB::table('assets')->where(['asset_category_id'=> 1])->get();
        //dd($order_status);
        $vehicle_dropdown = "<option selected >Select Vehicle</option>";
        foreach ($vehicles as $vehicle) {
            
                $vehicle_dropdown .= "<option value='".$vehicle->id."'>".$vehicle->name."</option>";
            
        }

        return view('departments.transport.woocommerce.orders.edit-order')->with(compact('sale_order','order_details','location_dropdown','users_dropdown','vehicle_dropdown'));
    }

    public function completeOrderTransport($id)
    {
        

            WpOrder::where(['id'=>$id])->update
                    ([
                        'location_status' => 7,
                        'delivery_status' => 5,
                        'is_assign' => 0,
                    ]);
            WpOrderAssign::where(['id'=>$id])->update
                    ([
                        'completed' => 1,
                    ]);
            $assign_orders = DB::table('wp_order_assign')
            ->where(['order_id'=> $id])
            ->first();

            User::where(['id'=>$assign_orders->rider_id])->update
            ([
                'is_assign' => 0,
            ]);
            return redirect('/transport/view-wp-orders')->with('flash_message_success','Order has been Forwarded Successfully!');
        
        
    }
    public function woopost()
    {
        $data = [
    'payment_method' => 'bacs',
    'payment_method_title' => 'Direct Bank Transfer',
    'set_paid' => true,
    'billing' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'address_1' => '969 Market',
        'address_2' => '',
        'city' => 'San Francisco',
        'state' => 'CA',
        'postcode' => '94103',
        'country' => 'US',
        'email' => 'john.doe@example.com',
        'phone' => '(555) 555-5555'
    ],
    'shipping' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'address_1' => '969 Market',
        'address_2' => '',
        'city' => 'San Francisco',
        'state' => 'CA',
        'postcode' => '94103',
        'country' => 'US'
    ],
    'line_items' => [
        [
            'product_id' => 10192,
            'quantity' => 2
        ],
        [
            'product_id' => 10194,
            'quantity' => 1
        ]
    ],
    'shipping_lines' => [
        [
            'method_id' => 'flat_rate',
            'method_title' => 'Flat Rate',
            'total' => '10.00'
        ]
    ]
];
$data = json_encode($data);

        $wp_orders = Woocommerce::post('orders',$data);
        dd($wp_orders);
    }
}
