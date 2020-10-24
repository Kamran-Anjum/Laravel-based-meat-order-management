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
use App\Models\User;

class SalesOrderSummaryController extends Controller
{
    public function viewOrdersSummary(){

    	$orders = DB::table('orders as o')
    	->whereIn('o.status',[5,6])
    	->join('purchase_order_status as ps','o.status','=','ps.id')
    	->join('users as u','o.user_id', '=', 'u.id')
    	->select('o.*','u.name as customerName','ps.name as s_status')
    	->get();

    	$roles = DB::table('roles')->whereNotIn('id',[1,2,3,4])->get();
            $roles_dropdown = "<option value='0' readonly selected > Select Role</option>";
            foreach ($roles as $role) {
                $roles_dropdown .= "<option value='".$role->name."'>".$role->name . "</option>";
            }
    	//dd($orders);
    	return view('admin.ordersummary.list-orders')->with(compact('orders','roles_dropdown'));
    }
}
