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
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductStock;
use App\Models\User;

class PackingController extends Controller
{
    public function packinglogin(Request $request)
    {
    	if($request->isMethod('post')){
    		$data = $request->input();
    		
    		if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                // Code: To set session
                /*
                Session::put('adminSession',$data['email']);
                */

    				return redirect('packing/dashboard');
    			}
    			else{
                    return redirect('/packing')->with('flash_message_error','Invalid Username or Password');
                }
    	}
        return view('departments.packing.packing-login');
    }
    public function dashboard(){
       
        $orders = DB::table('orders')->where(['location_status'=> 3])->whereDate('created_at',date('Y-m-d'))->get();
        $today_sales = 0;
        if(count($orders) == 0) {
            $today_sales = 0;
        }
        else{
        	$today_sales = count($orders);
        }
        $today_purchase = 0;
                //dd($total_amount);
        return view('departments.packing.dashboard')->with(compact('today_sales','today_purchase'));
    }

    public function logout(){
        Session::flush();
        return redirect('/packing')->with('flash_message_success','Logged out Successfully');
    }

    /*starts order controlling functions*/

    public function viewOrders(){

    	$orders = DB::table('orders as o')
    	->where(['location_status'=> 3])
    	->join('po_priority_status as pos','o.priority_status','=','pos.id')
    	->join('purchase_order_status as ps','o.status','=','ps.id')
    	->join('order_location_status as ols','o.location_status','=','ols.id')
    	->join('users as u','o.created_by', '=', 'u.id')
    	->select('o.*','u.name as order_by','pos.name as pr_status','ps.name as s_status','ols.name as loc_status')
    	->get();
    	//dd($orders);
    	return view('departments.packing.orders.list-orders')->with(compact('orders'));
    }

    public function editOrder(Request $request, $id =null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            Order::where(['id'=>$id])->update
            ([
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

        $order_status = DB::table('purchase_order_status')->whereNotIn('id',[1,2,3,4,5,6,9])->get();
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
        $location_status = DB::table('order_location_status')->whereNotIn('id',[1,2,5])->get();
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
        return view('departments.packing.orders.edit-order')->with(compact('sale_order','status_dropdown','location_dropdown','priority_dropdown','order_details'));
    }
}
