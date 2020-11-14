<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Session;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductStock;

class FrontCustomerController extends Controller
{
    public function frontcustomerlogin(Request $request)
    {
    	if($request->isMethod('post')){
    		$data = $request->input();
    		
    		if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                // Code: To set session
                /*
                Session::put('adminSession',$data['email']);
                */

    				return redirect('user/dashboard');
    			}
    			else{
                    return redirect('/')->with('flash_message_error','Invalid Username or Password');
                }
    	}
        return view('customers.customers-login');
    }

    public function dashboard(){
        
        return view('customers.dashboard');
    }

    public function viewOrders()
    {
    	$user = Auth::User();

    	$user_orders = DB::table('orders as o')
    	->where(['o.user_id'=> $user->id])
    	->join('po_priority_status as pos','o.priority_status','=','pos.id')
    	->join('purchase_order_status as ps','o.status','=','ps.id')
    	->join('order_location_status as ols','o.location_status','=','ols.id')
    	->join('users as u','o.created_by', '=', 'u.id')
    	->select('o.*','u.name as order_by','pos.name as pr_status','ps.name as s_status','ols.name as loc_status')
    	->get();

    	return view('customers.orders.list-orders')->with(compact('user_orders'));
    }

    public function addOrder(Request $request){

    	$user = Auth::User();

    	if($request->isMethod('post')){
    		$data = $request->all();
    		//dd($data);

    		$order = new Order();
    		$order->user_id = $user->id;
    		$order->name = $data['shipping_name'];
    		$order->cell_no = $data['shipping_cell'];
    		$order->email = $data['shipping_email'];
    		$order->billing_address = "From Depo";
    		$order->shipping_address = $data['shipping_address'].", ".$data['shipping_city'].", Norway";
    		$order->total_amount = $data['total_price'];
    		$order->priority_status = 1;
    		$order->location_status = 1;
    		$order->status = 1;
    		$order->is_assign = 0;
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
                    $order_detail->discount = 0;
                    $order_detail->discount_amount = 0;
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

                return redirect('user/view-orders')->with('flash_message_success','Sale Order successfully Added!');
    	}
    	$authorizedRoles = ['internal customer', 'external customer', 'private customer','workforce'];

    	$user_role = User::with('roles')->where(['id'=>$user->id])->first();
    	//dd($user_role->roles->first()->name);
    	//dd($user_role);

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
		
		//dd($users);

    	return view('customers.orders.create-order')->with(compact('user_role','categories_dropdown','city_dropdown'));
    }

    //Ajax Requests for frontend Users
    //get Product subcategories by category id
    //Get Subcategories
    public function getsubcategoriesdropdown($id = null){

        $subcategories = DB::table('subcategories')
                ->whereIn('category_id',array($id))->get();

                $subcategories_dropdown = "<option disabled selected>Select Sub Category</option>";
                foreach($subcategories as $subcategory){
                    $subcategories_dropdown .= "<option value='".$subcategory->id."'>".$subcategory->name . "</option>";      
                     }
        
        
        return $subcategories_dropdown;

    }
    //Get Products by subcategories
    public function getproductsdropdown($id = null){

        $subcategories = DB::table('product_sub_categories as ps')
                ->where(['ps.subcategory_id'=>$id])
                ->join('products as p','p.id','=','ps.product_id')
                ->select('p.*')
                ->get();

                $products_dropdown = "<option disabled selected>Select Product</option>";
                foreach($subcategories as $subcategory){
                    $products_dropdown .= "<option value='".$subcategory->id."'>".$subcategory->name . "</option>";      
                     }
        
        
        return array($subcategories,$products_dropdown);

    }
    //Get Products Stock $ Sale Price for sales Order
    public function getproductstockprice($id, $cusid){

        $stocks = DB::table('product_stocks')
                ->where(['product_id'=>$id])
                ->first();
        $balance_stock = $stocks->recieve_qty - $stocks->sale_qty;

        $authorizedRoles = ['internal customer', 'external customer', 'private customer','workforce'];
        
        $user_role = User::with('roles')->where(['id'=>$cusid])->first();

        $role_id = $user_role->roles->first()->id;
        $customer_sale_price = DB::table('customer_price')
                                ->where(['role_id'=>$role_id])
                                ->first();
        $products = DB::table('products')->where(['id'=>$id])->first();

        $base_price_percent = $products->base_price/100*$customer_sale_price->price_percent;

        $sales_price = $products->base_price + $base_price_percent;
        
        
        return array($balance_stock,$sales_price);

    }

}
