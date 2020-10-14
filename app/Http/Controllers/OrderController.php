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
use App\Models\User;

class OrderController extends Controller
{
    public function viewOrders(){

    	$orders = DB::table('orders as o')
    	->join('po_priority_status as pos','o.priority_status','=','pos.id')
    	->join('purchase_order_status as ps','o.status','=','ps.id')
    	->join('order_location_status as ols','o.location_status','=','o.id')
    	->join('users as u','o.created_by', '=', 'u.id')
    	->select('o.*','u.name as order_by','pos.name as pr_status','ps.name as s_status','ols.name as loc_status')
    	->get();

    	return view('admin.orders.list-orders')->with(compact('orders'));
    }

    public function createOrder(Request $request){

    	$user = Auth::User();

    	if($request->isMethod('post')){
    		$data = $request->all();
    	}
    	$authorizedRoles = ['internal customer', 'external customer', 'private customer','workforce'];

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
		//dd($users);

    	return view('admin.orders.create-order')->with(compact('customer_dropdown','categories_dropdown'));
    }
}
