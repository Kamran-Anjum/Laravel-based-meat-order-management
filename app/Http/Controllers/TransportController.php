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
use App\Models\OrderAssign;
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
    	->whereIn('o.status', [11,13,14,15])
    	->join('po_priority_status as pos','o.priority_status','=','pos.id')
    	->join('purchase_order_status as ps','o.status','=','ps.id')
        ->join('purchase_order_status as pso','o.delivery_status','=','pso.id')
    	->join('order_location_status as ols','o.location_status','=','ols.id')
    	->join('users as u','o.created_by', '=', 'u.id')
    	->select('o.*','u.name as order_by','pos.name as pr_status','ps.name as s_status','ols.name as loc_status','pso.name as delivery_statuss')
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
        $token = "1688894217.hBpAwTwLZjUp4XvPgDPnQUZSk4FiWzs8";

    	$curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.fiken.no/api/v2/companies/fiken-demo-venstre-vik-as/products",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache",
      "Authorization: Bearer 1688894217.hBpAwTwLZjUp4XvPgDPnQUZSk4FiWzs8"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);
  //$response = json_encode($response);
  curl_close($curl);

  $response = json_decode($response);
    dd($response);
    	
    }
public function fikenPost()
{
    //$data = new array();
    $data = ["uuid"=> "123e4567-e89b-12d3-a456-426655440000",
    "issueDate"=> "2020-12-20",
    "dueDate"=> "2020-12-20",
    "lines"=> [
    [
      "net"=> 7500,
      "vat"=> 1125,
      "vatType"=> "MEDIUM",
      "gross"=> 8625,
      //"vatInPercent"=> 0.2500000000,
      "unitPrice"=> 7500,
      "quantity"=> 1,
      //"discount"=> 25,
      "productName"=> "Gardening Gloves VI2",
      "productId"=> 2888156,
      "description"=> "Goatskin, with extra-long suede cuffs",
      "comment"=> "One size fits all",
      "incomeAccount"=> 3000
    ]
  ],
  "customerId"=> 1703087210,
  "bankAccountCode"=> "1920:10001",
  "currency"=> "NOK",
  "invoiceText"=> "Invoice for services rendered during the Oslo Knitting Festival.",
  "cash"=> true,
  "paymentAccount"=> "1920:10001",
];
/*$data = json_encode($data);
dd($data);*/
//$data = ["unitPrice"=> "3000","name"=> "abcd","vatType"=>"high","incomeAccount"=>"3000"
//];

/*$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.fiken.no/api/v2/companies/fiken-demo-venstre-vik-as/invoices',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"uuid":"123e4567-e89b-12d3-a456-426655440000","issueDate":"2020-12-20","dueDate":"2020-12-20","lines":[{"net":7500,"vat":1125,"vatType":"MEDIUM","gross":8625,"unitPrice":7500,"quantity":1,"productName":"Gardening Gloves VI2","productId":2888156,"description":"Goatskin, with extra-long suede cuffs","comment":"One size fits all","incomeAccount":3000}],"customerId":1703087210,"bankAccountCode":"1920:10001","currency":"NOK","invoiceText":"Invoice for services rendered during the Oslo Knitting Festival.","cash":true,"paymentAccount":"1920:10001"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'Authorization: Bearer 1688894217.hBpAwTwLZjUp4XvPgDPnQUZSk4FiWzs8',
    'Cookie: JSESSIONID=YTJmYzM2OGUtOTExYi00MjFmLTgyMjMtMzYyNzJiOTAwYjVm'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
dd($response);*/

                    //header('Content-Type: application/json'); 
                    $chz = curl_init("https://api.fiken.no/api/v2/companies/fiken-demo-venstre-vik-as/invoices"); 
                                $data = json_encode($data);
                                $authorization = 'Authorization: Bearer 1688894217.hBpAwTwLZjUp4XvPgDPnQUZSk4FiWzs8'; 
                                curl_setopt($chz, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization, 'Cookie: JSESSIONID=YTJmYzM2OGUtOTExYi00MjFmLTgyMjMtMzYyNzJiOTAwYjVm' )); 
                                curl_setopt($chz, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($chz, CURLOPT_POST, 1); 
                                curl_setopt($chz, CURLOPT_HEADER, true);
                                curl_setopt($chz, CURLOPT_CUSTOMREQUEST, "POST");
                                curl_setopt($chz, CURLOPT_POSTFIELDS, $data); 
                                curl_setopt($chz, CURLOPT_FOLLOWLOCATION, false); 
                                $resultz = curl_exec($chz); 
                                $header_size = curl_getinfo($chz);
                                $headers = substr($resultz, 0, $header_size["header_size"]); //split out header
                                preg_match("!\r\n(?:location|URI): *(.*?) *\r\n!", $headers, $matches);
                                $url = $matches[1];
                                curl_close($chz);
                                /*print_r($info)."<br>";*/
                                dd($url);
                                print_r($resultz);
                                die();
                                //$resultz . PHP_EOL; 
                                //$resultz = json_decode($resultz, true);
                                //dd($resultz);
                                //$status = $resultz["ResponseCode"];

}
    public function editOrder(Request $request, $id =null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            Order::where(['id'=>$id])->update
            ([
                'location_status' => 6,
                'delivery_status' => $data['status'],
                'is_assign' => 1,
            ]);

            $assign_orders = DB::table('order_assign')
            ->where(['order_id'=> $id])
            ->get();
            if (count($assign_orders) == 0) {
                $assign = new OrderAssign();
                $assign->order_id = $id;
                $assign->rider_id = $data["rider"];
                $assign->vehicle_id = $data["vehicle"];
                $assign->save();
            }

            User::where(['id'=>$data["rider"]])->update
            ([
                'is_assign' => 1,
            ]);


            return redirect('/transport/view-orders')->with('flash_message_success','Order has been Assigned Successfully!');
        }

        $sale_order = DB::table('orders as o')->where(['o.id'=>$id])
        ->join('users as u','o.user_id','=','u.id')
        ->join('order_location_status as ol','o.location_status','=','ol.id')
        ->join('purchase_order_status as ps','o.status','=','ps.id')
        ->select('o.*','u.name as cusName','ol.name as location_name','ps.name as stateus')->first();

        $order_details = DB::table('order_details as od')->where(['od.order_id'=>$id])
        ->join('products as p','od.product_id','=','p.id')
        ->select('od.*','p.name as prodName')
        ->get();

        $order_status = DB::table('purchase_order_status')->whereIn('id',[14,15])->get();
        //dd($order_status);
        $status_dropdown = "<option selected >Select Status</option>";
        foreach ($order_status as $status) {
            
                $status_dropdown .= "<option value='".$status->id."'>".$status->name."</option>";
            
        }

        $vehicles = DB::table('assets')->where(['asset_category_id'=> 1])->get();
        //dd($order_status);
        $vehicle_dropdown = "<option selected >Select Vehicle</option>";
        foreach ($vehicles as $vehicle) {
            
                $vehicle_dropdown .= "<option value='".$vehicle->id."'>".$vehicle->name."</option>";
            
        }

        $location_status = DB::table('order_location_status')->whereNotIn('id',[1,3,2,5])->get();
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
        $rolename = 10;
        $user_by_roles = User::whereHas('roles', function ($q) use ($rolename) {
            $q->where('id', $rolename);
            })->get();

        $users_dropdown = "<option selected value='0' readonly>Select User</option>";
            foreach ($user_by_roles as $users) {
                $users_dropdown .= "<option value='".$users->id."'>".$users->name . "</option>";
            }
        //dd($priority_dropdown);
        return view('departments.transport.orders.edit-order')->with(compact('sale_order','status_dropdown','location_dropdown','priority_dropdown','order_details','users_dropdown','vehicle_dropdown'));
    }

    public function completeOrder(Request $request, $id =null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            Order::where(['id'=>$id])->update
            ([
                'location_status' => 7,
                'status' => $data['status'],
                'delivery_status' => $data['status'],
                'is_assign' => 0,
            ]);

            $assign_orders = DB::table('order_assign')
            ->where(['order_id'=> $id])
            ->first();
            
            User::where(['id'=>$assign_orders->rider_id])->update
            ([
                'is_assign' => 0,
            ]);


            return redirect('/transport/view-orders')->with('flash_message_success','Order has been Complete Successfully!');
        }

        $sale_order = DB::table('orders as o')->where(['o.id'=>$id])
        ->join('users as u','o.user_id','=','u.id')
        ->join('order_location_status as ol','o.location_status','=','ol.id')
        ->join('purchase_order_status as ps','o.status','=','ps.id')
        ->select('o.*','u.name as cusName','ol.name as location_name','ps.name as stateus')->first();

        $order_details = DB::table('order_details as od')->where(['od.order_id'=>$id])
        ->join('products as p','od.product_id','=','p.id')
        ->select('od.*','p.name as prodName')
        ->get();

        $order_status = DB::table('purchase_order_status')->whereIn('id',[5])->get();
        //dd($order_status);
        $status_dropdown = "";
        foreach ($order_status as $status) {
            
                $status_dropdown .= "<option selected value='".$status->id."'>".$status->name."</option>";
            
        }

        $vehicles = DB::table('assets')->where(['asset_category_id'=> 1])->get();
        //dd($order_status);
        $vehicle_dropdown = "<option selected >Select Vehicle</option>";
        foreach ($vehicles as $vehicle) {
            
                $vehicle_dropdown .= "<option value='".$vehicle->id."'>".$vehicle->name."</option>";
            
        }

        $location_status = DB::table('order_location_status')->whereNotIn('id',[1,3,2,5])->get();
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
        $rolename = 10;
        $user_by_roles = User::whereHas('roles', function ($q) use ($rolename) {
            $q->where('id', $rolename);
            })->get();

        $users_dropdown = "<option selected value='0' readonly>Select User</option>";
            foreach ($user_by_roles as $users) {
                $users_dropdown .= "<option value='".$users->id."'>".$users->name . "</option>";
            }
        //dd($priority_dropdown);
        return view('departments.transport.orders.complete-order')->with(compact('sale_order','status_dropdown','location_dropdown','priority_dropdown','order_details','users_dropdown','vehicle_dropdown'));
    }

    public function partialOrder(Request $request, $id =null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            Order::where(['id'=>$id])->update
            ([
                'location_status' => 2,
                'status' => $data['status'],
                'delivery_status' => $data['status'],
                'is_assign' => 0,
            ]);

            $assign_orders = DB::table('order_assign')
            ->where(['id'=> $id])
            ->get();

            $assign_orders = DB::table('order_assign')
            ->where(['order_id'=> $id])
            ->first();
            
            User::where(['id'=>$assign_orders->rider_id])->update
            ([
                'is_assign' => 0,
            ]);


            return redirect('/transport/view-orders')->with('flash_message_success','Order has been Partial Delivered Successfully!');
        }

        $sale_order = DB::table('orders as o')->where(['o.id'=>$id])
        ->join('users as u','o.user_id','=','u.id')
        ->join('order_location_status as ol','o.location_status','=','ol.id')
        ->join('purchase_order_status as ps','o.status','=','ps.id')
        ->select('o.*','u.name as cusName','ol.name as location_name','ps.name as stateus')->first();

        $order_details = DB::table('order_details as od')->where(['od.order_id'=>$id])
        ->join('products as p','od.product_id','=','p.id')
        ->select('od.*','p.name as prodName')
        ->get();

        $order_status = DB::table('purchase_order_status')->whereIn('id',[6])->get();
        //dd($order_status);
        $status_dropdown = "";
        foreach ($order_status as $status) {
            
                $status_dropdown .= "<option selected value='".$status->id."'>".$status->name."</option>";
            
        }

        $vehicles = DB::table('assets')->where(['asset_category_id'=> 1])->get();
        //dd($order_status);
        $vehicle_dropdown = "<option selected >Select Vehicle</option>";
        foreach ($vehicles as $vehicle) {
            
                $vehicle_dropdown .= "<option value='".$vehicle->id."'>".$vehicle->name."</option>";
            
        }

        $location_status = DB::table('order_location_status')->whereNotIn('id',[1,3,2,5])->get();
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
        $rolename = 10;
        $user_by_roles = User::whereHas('roles', function ($q) use ($rolename) {
            $q->where('id', $rolename);
            })->get();

        $users_dropdown = "<option selected value='0' readonly>Select User</option>";
            foreach ($user_by_roles as $users) {
                $users_dropdown .= "<option value='".$users->id."'>".$users->name . "</option>";
            }
        //dd($priority_dropdown);
        return view('departments.transport.orders.partial-order')->with(compact('sale_order','status_dropdown','location_dropdown','priority_dropdown','order_details','users_dropdown','vehicle_dropdown'));
    }
    public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_success','Logged out Successfully');
    }

    public function wooPost()
    {

$data = ['order'=> [
    'payment_method' => 'bacs',
    'payment_method_title' => 'Direct Bank Transfer',
    'set_paid' => true,
    'billing' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'address_1' => '969 Market',
        'address_2' => '',
        'city' => 'Karachi',
        'state' => 'SINDH',
        'postcode' => '75520',
        'country' => 'PK',
        'email' => 'john.doe@example.com',
        'phone' => '(555) 555-5555'
    ],
    'shipping' => [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'address_1' => '969 Market',
        'address_2' => '',
        'city' => 'Karachi',
        'state' => 'SINDH',
        'postcode' => '94103',
        'country' => 'PK'
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
   ] 
];
$data = json_encode($data);
//dd($data);
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://foreeshop.com/wp-json/wc/v3/orders/',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$data,
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic Y2tfYzU3NzVmYzE4MTM5NmYyMDNiOTg0YjRjMjg1MjY3ZjQwOWUzZTYwNTpjc184ODI1MjljOTQ2ODBkM2JlZjdjOGIyMmM3ZTcxMTY2MDM3MmNjMjM4',
    'Content-Type: json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
dd($response);

    }
}
