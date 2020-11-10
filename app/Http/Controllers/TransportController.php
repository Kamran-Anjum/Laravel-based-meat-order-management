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
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\ProductStockRecieve;
use App\Models\Product;
use PDF;

class TransportController extends Controller
{
    public function transportlogin(Request $request)
    {
    	if($request->isMethod('post')){
    		$data = $request->input();
    		
    		if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                // Code: To set session
                /*
                Session::put('adminSession',$data['email']);
                */

    				return redirect('transport/dashboard');
    			}
    			else{
                    return redirect('/transport')->with('flash_message_error','Invalid Username or Password');
                }
    	}
        return view('departments.transport.transport-login');
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
        return view('departments.transport.dashboard')->with(compact('today_sales','today_purchase'));
    }

    public function viewOrders(){

    	$orders = DB::table('orders as o')
    	->where(['location_status'=> 4])
    	->join('po_priority_status as pos','o.priority_status','=','pos.id')
    	->join('purchase_order_status as ps','o.status','=','ps.id')
    	->join('order_location_status as ols','o.location_status','=','ols.id')
    	->join('users as u','o.created_by', '=', 'u.id')
    	->select('o.*','u.name as order_by','pos.name as pr_status','ps.name as s_status','ols.name as loc_status')
    	->get();
    	//dd($orders);
    	return view('departments.transport.orders.list-orders')->with(compact('orders'));
    }
    //Vehicle View
    public function viewVehicles(){

    	$assets = DB::table('assets as a')
    	->where(['a.asset_category_id'=> 1])
    	->join('assets_vehicle_details as av','a.id','=','av.asset_id')
    	->select('a.*','av.reg_no as regno')
    	->get();
    	//dd($orders);
    	return view('departments.transport.vehicles.view-assets')->with(compact('assets'));
    }

    public function viewRider(){

    	$authorizedRoles = ['Rider'];

		$users = User::whereHas('roles', static function ($query) use ($authorizedRoles) {
                    return $query->whereIn('name', $authorizedRoles);
                })->with('roles')->get();
		//dd($users);
    	return view('departments.transport.riders.view-riders')->with(compact('users'));
    }

    public function testFekin()
    {
    	$curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://fiken.no/api/v1/rel/invoices",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
       CURLOPT_HTTPHEADER => array(
         "Username: post@kjottsentralen.no",
         "Password: Kswwqq2018"
       ),
      ));

      $response = curl_exec($curl);

    curl_close($curl);

    $response = json_decode($response);
    dd($response);
    	
    }
}
