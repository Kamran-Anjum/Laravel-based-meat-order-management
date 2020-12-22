<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductStock;
use App\Models\ForwardStock;
use App\Models\User;

class ProductionOrderController extends Controller
{
    public function viewOrders(){

    	$orders = DB::table('orders as o')
    	->join('po_priority_status as pos','o.priority_status','=','pos.id')
    	->join('purchase_order_status as ps','o.status','=','ps.id')
    	->join('order_location_status as ols','o.location_status','=','ols.id')
    	->join('users as u','o.created_by', '=', 'u.id')
    	->select('o.*','u.name as order_by','pos.name as pr_status','ps.name as s_status','ols.name as loc_status')
    	->get();
    	//dd($orders);
    	return view('departments.production.orders.list-orders')->with(compact('orders'));
    }

    public function createOrder(Request $request){

    	$user = Auth::User();

    	if($request->isMethod('post')){
    		$data = $request->all();
    		//dd($data);

    		$order = new Order();
    		$order->user_id = $data['customer_id'];
            $order->wp_order_id = 0;
    		$order->name = $data['shipping_name'];
    		$order->cell_no = $data['shipping_cell'];
    		$order->email = $data['shipping_email'];
    		$order->billing_address = "From Depo";
    		$order->shipping_address = $data['shipping_address'].", ".$data['shipping_city'].", Norway";
    		$order->total_amount = $data['total_price'];
    		$order->priority_status = $data['pr_status'];
    		$order->location_status = 2;
    		$order->status = 1;
    		$order->order_note = $data['order_note'];
    		$order->created_by = $user->id;
    		$order->order_date = $data['order_date'];
    		$order->save();
    		$order_id = $order->id;

    		for ($i=0; $i <count($data['product_ids']) ; $i++) { 
                    
                    $order_detail = new OrderDetail();
                    $order_detail->order_id = $order_id;
                    $order_detail->product_id = $data['product_ids'][$i];
                    $order_detail->unit_price = $data['sale_price'][$i];
                    $order_detail->discount = $data['discount'][$i];
                    $order_detail->discount_amount = $data['discount_amount'][$i];
                    $order_detail->quantity = $data['quantity'][$i];
                    $order_detail->unit = $data['unit'][$i];
                    $order_detail->total_price = $data['subtotal'][$i];
                    $order_detail->created_by = $user->id;
                    $order_detail->save();

                    $stock = DB::table('product_stocks')->where(['product_id'=>$data['product_ids'][$i]])->first();

                    ProductStock::where(['product_id'=>$data['product_ids'][$i]])->update
            		([
                		'sale_qty' => $stock->sale_qty+$data['quantity'][$i],
                		'balanced_qty' => $stock->balanced_qty-$data['quantity'][$i],
            
            		]);
                }

                return redirect('production/view-orders')->with('flash_message_success','Sale Order successfully Added!');
    	}
    	$authorizedRoles = ['internal-customer', 'external-customer', 'private-customer','workforce'];

		$customers = User::whereHas('roles', static function ($query) use ($authorizedRoles) {
                    return $query->whereIn('name', $authorizedRoles);
                })->with('roles')->get();
		$customer_dropdown = "<option selected disabled >Select Customer</option>";
		foreach ($customers as $customer) {
			$customer_dropdown .= "<option value='".$customer->id."'>".$customer->name." (".$customer->roles->first()->name.")</option>";
		}

		$categories = DB::table('categories')->get();
		$categories_dropdown = "<option selected disabled >Select Category</option>";
		foreach ($categories as $category) {
			$categories_dropdown .= "<option value='".$category->id."'>".$category->name."</option>";
		}
		$cities = DB::table('cities')->get();
		$city_dropdown = "<option selected disabled >Select City</option>";
		foreach ($cities as $city) {
			$city_dropdown .= "<option value='".$city->name."'>".$city->name."</option>";
		}
		$pr_status = DB::table('po_priority_status')->get();
		$pr_ststus_dropdown = "<option selected disabled >Select Status</option>";
		foreach ($pr_status as $p_status) {
			$pr_ststus_dropdown .= "<option value='".$p_status->id."'>".$p_status->name."</option>";
		}
		$location = DB::table('order_location_status')->get();
		$loc_status_dropdown = "<option selected disabled >Select Department</option>";
		foreach ($location as $loc_status) {
			$loc_status_dropdown .= "<option value='".$loc_status->id."'>".$loc_status->name."</option>";
		}
		//dd($users);

    	return view('departments.production.orders.create-order')->with(compact('customer_dropdown','categories_dropdown','city_dropdown','pr_ststus_dropdown','loc_status_dropdown'));
    }

    //Edit sales order
    public function editOrder(Request $request, $id =null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            if (isset($data['lf_quantity'])) {

                for ($i=0; $i <count($data['order_d_id']) ; $i++) { 
                    $current_qty[] = $data['lf_quantity'][$i]+$data['f_quantity'][$i];
                    $bal_qty[] = $data['quantity'][$i]-$current_qty[$i];


                
                }
                for ($j=0; $j <count($data['order_d_id']) ; $j++) { 
                   ForwardStock::where(['order_detail_id'=>$data['order_d_id'][$j]])->update
                    ([
                        'forward_qty' => $current_qty[$j],
                        'balance_qty' => $bal_qty[$j],
                    ]);
                }
                //dd($current_qty, $bal_qty);
                //dd($bal_qty);
                //$bal_qty = $data['quantity']-$current_qty;
                
            }
            else{
                for ($i=0; $i <count($data['order_d_id']) ; $i++) { 
                    $bal_qty[] = $data['quantity'][$i]-$data['f_quantity'][$i];

                    $forward_stock = new ForwardStock();
                    $forward_stock->order_detail_id = $data['order_d_id'][$i];
                    $forward_stock->forward_qty = $data['f_quantity'][$i];
                    $forward_stock->balance_qty = $bal_qty[$i];
                    $forward_stock->save();
                    }
            }
            Order::where(['id'=>$id])->update
            ([
                'priority_status' => $data['pr_status'],
                'location_status' => $data['dept_status'],
                'status' => $data['status'],
            ]);

            return redirect('/production/view-orders')->with('flash_message_success','Order Status has been Updated Successfully!');
        }

        $sale_order = DB::table('orders as o')->where(['o.id'=>$id])
        ->join('users as u','o.user_id','=','u.id')
        ->select('o.*','u.name as cusName')->first();

        $order_details = DB::table('order_details as od')->where(['od.order_id'=>$id])
        ->join('products as p','od.product_id','=','p.id')
        ->select('od.*','p.name as prodName')
        ->get();

        $order_status = DB::table('purchase_order_status')->whereIn('id',[8,12])->get();
        //dd($order_status);
        $status_dropdown = "";
        foreach ($order_status as $status) {
        	if ($status->id == $sale_order->status) {
        		$status_dropdown .= "<option selected value='".$status->id."'>".$status->name."</option>";
        	}
        	else{
        		$status_dropdown .= "<option value='".$status->id."'>".$status->name."</option>";
        	}
        }
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
        //dd($location_dropdown);

        $prority_status = DB::table('po_priority_status')->get();
        //dd($order_status);
        $priority_dropdown = "";
        foreach ($prority_status as $pr_status) {
        	if ($pr_status->id == $sale_order->priority_status) {
        		$priority_dropdown .= "<option selected value='".$pr_status->id."'>".$pr_status->name."</option>";
        	}
        	else{
        		$priority_dropdown .= "<option value='".$pr_status->id."'>".$pr_status->name."</option>";
        	}
        }
        //dd($priority_dropdown);
        return view('departments.production.orders.edit-order')->with(compact('sale_order','status_dropdown','location_dropdown','priority_dropdown','order_details'));
    }
}
