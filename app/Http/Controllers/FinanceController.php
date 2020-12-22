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
use App\Models\Expence;
use Image;

class FinanceController extends Controller
{
    public function financelogin(Request $request)
    {
    	if($request->isMethod('post')){
    		$data = $request->input();
    		
    		if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                // Code: To set session
                /*
                Session::put('adminSession',$data['email']);
                */

    				return redirect('finance/dashboard');
    			}
    			else{
                    return redirect('/finance')->with('flash_message_error','Invalid Username or Password');
                }
    	}
        return view('departments.finance.finance-login');
    }

    public function dashboard(){
        $orders = DB::table('orders')->where(['delivery_status'=> [5]])->get();
        //dd($orders);
        $today_sales = 0;
        foreach ($orders as $value) {
            $today_sales = $today_sales+$value->total_amount;
        }
        $wp_sales = DB::table('wp_orders')->where(['status'=>'completed'])->get();
        $wp_total_sales = 0;
        foreach ($wp_sales as $wp_sale) {
            $wp_total_sales = $wp_total_sales+$wp_sale->total_amount;
        }
        $porders = DB::table('purchase_order')->where(['status' => 2])->get();
        $today_purchase = 0;
        foreach ($porders as $pvalue) {
            $today_purchase = $today_purchase+$pvalue->total_amount;
        }
        $expences = DB::table('expences')->get();
        $today_expence = 0;
        foreach ($expences as $expence) {
            $today_expence = $today_expence+$expence->amount;
        }

        $sale_sum = $wp_total_sales+$today_sales;

        $totalexp = $today_purchase+$today_expence;

        $profit_loss = $sale_sum-$totalexp;
                //dd($total_amount);
        return view('departments.finance.dashboard')->with(compact('today_sales','today_purchase','today_expence','wp_total_sales','profit_loss'));
    }

    public function commingsoon()
    {
    	return view('admin.working.working');
    }

    public function viewOrders(){

        $orders = DB::table('orders as o')
        ->where(['delivery_status'=> 5])
        ->join('po_priority_status as pos','o.priority_status','=','pos.id')
        ->join('purchase_order_status as ps','o.status','=','ps.id')
        ->join('order_location_status as ols','o.location_status','=','ols.id')
        ->join('users as u','o.created_by', '=', 'u.id')
        ->select('o.*','u.name as order_by','pos.name as pr_status','ps.name as s_status','ols.name as loc_status')
        ->get();
        //dd($orders);
        return view('departments.finance.orders.list-orders')->with(compact('orders'));
    }

    public function viewExpences()
    {
        $expences = DB::table('expences as e')
        ->join('expence_type as et', 'e.type','=','et.id')
        ->join('users as u','e.created_by','=','u.id')
        ->select('e.*','et.name as typeName','u.name as userName')
        ->get();
        return view('departments.finance.expence.view-expences')->with(compact('expences'));
    }

    public function addExpence(Request $request){
        $user = Auth::User();

        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $expence = new Expence();
            $expence->name = $data['e_name'];
            $expence->type = $data['e_type'];
            $expence->amount = $data['e_price'];
            $expence->created_by = $user->id;
            if($request->hasFile('image')){

                $image_tmp = $request->image;
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = 'expence'.rand(1111,9999999).'.'.$extension;
                        $large_image_path = 'images/backend-images/halalmeat/expence/large/'.$filename;
                        $medium_image_path = 'images/backend-images/halalmeat/expence/medium/'.$filename;
                        $small_image_path = 'images/backend-images/halalmeat/expence/small/'.$filename;
                        $tiny_image_path = 'images/backend-images/halalmeat/expence/tiny/'.$filename;
                        Image::make($image_tmp)->save($large_image_path);
                        Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(166,266)->save($small_image_path);
                        Image::make($image_tmp)->resize(100,100)->save($tiny_image_path);
                        $expence->image = $filename;
                    }
                }
            $expence->save();

            return redirect('finance/view-expence')->with('flash_message_success','Expence successfully Added!');
        }

        $expence_type = DB::table('expence_type')->get();
        $expence_dropdown = "<option disabled selected > Select Type</option>";

        foreach ($expence_type as $exp) {
            $expence_dropdown .="<option value='".$exp->id."'>".$exp->name . "</option>";
        }
        return view('departments.finance.expence.create-expence')->with(compact('expence_dropdown'));
    }
    public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_success','Logged out Successfully');
    }

    public function viewPurchaseOrders()
    {
        $user = Auth::User();
        if (!empty($user)) {
            $purchase_orders = DB::table('purchase_order as po')
            ->join('suppliers as s','po.supplier_id','=','s.id')
            //->join('purchase_order_detail as pod','po.id','=','pod.p_order_id')
            //->join('products as p','pod.product_id','=','p.id')
            ->join('users as u','po.created_by', '=', 'u.id')
            ->join('purchase_order_status as pos','po.status','=','pos.id')
            ->join('po_priority_status as pps','pr_status','=','pps.id')
            ->select('po.*','s.supplier_name as suppName','u.name as userName','pos.name as sstatus','pps.name as prStatus')
            ->get();
        return view('departments.finance.purchaseorder.view-purchase-orders')->with(compact('purchase_orders'));
        }
        else{
            return redirect('/admin');
        }
        
    }

    public function createInvoice($id)
    {
    //$data = new array();
    
        $order_user_id = DB::table('orders')
        ->where(['id'=>$id])
        ->first();

        $customer_id = DB::table('customer_details')
        ->where(['user_id'=>$order_user_id->user_id])
        ->first();

        $order_products = DB::table('order_details')
        ->where(['order_id'=>$id])
        ->get();

        //$products = [];
        $x = 0;
        foreach ($order_products as $value) {
            $dbproducts = DB::table('products')->where(['id'=>$value->product_id])->first();
            $products[] = ["fiken_id"=>$dbproducts->fiken_product_id, "name"=>$dbproducts->name,"code"=>$dbproducts->fiken_account_code,"amount"=>$value->total_price]; 
        }
//dd($products);
for ($i=0; $i <count($products) ; $i++) { 
    $data = ["unitPrice"=> $products[$i]["amount"],"name"=> $products[$i]["name"],"vatType"=>"high","incomeAccount"=>$products[$i]["code"]
];
                $chz = curl_init("https://api.fiken.no/api/v2/companies/fiken-demo-venstre-vik-as/products/".$products[$i]["fiken_id"]); 
                                $data = json_encode($data);
                                $authorization = "Authorization: Bearer 1688894217.hBpAwTwLZjUp4XvPgDPnQUZSk4FiWzs8"; 
                                curl_setopt($chz, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json' , $authorization )); 
                                curl_setopt($chz, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($chz, CURLOPT_POST, 1); 
                                curl_setopt($chz, CURLOPT_CUSTOMREQUEST, "PUT");
                                curl_setopt($chz, CURLOPT_POSTFIELDS, $data); 
                                curl_setopt($chz, CURLOPT_FOLLOWLOCATION, 1); 
                                $resultz = curl_exec($chz); 
                                $info = curl_getinfo($chz);
                                curl_close($chz);
                                
}

foreach ($order_products as $value) {
    $dbproducts = DB::table('products')->where(['id'=>$value->product_id])->first();
    $product_invoice[] = ["fiken_id"=>$dbproducts->fiken_product_id, "name"=>$dbproducts->name,"code"=>$dbproducts->fiken_account_code,"amount"=>$value->total_price,"price"=>$value->unit_price,"quantity"=>$value->quantity,'discount'=>$value->discount_amount]; 
}
//dd($product_invoice);
for ($i=0; $i <count($product_invoice) ; $i++) { 
    $net_amount = $product_invoice[$i]["amount"]+$product_invoice[$i]["discount"];
    $vat_amount = $net_amount*0.25;
    //dd($vat_amount,$net_amount);
$sub_data[] =[
      "net"=> $net_amount,
      "vat"=> $vat_amount,
      "vatType"=> "HIGH",
      "gross"=> $net_amount+$vat_amount,
      //"vatInPercent"=> 0.2500000000,
      "unitPrice"=> $product_invoice[$i]["price"],
      "quantity"=> $product_invoice[$i]["quantity"],
      //"discount"=> 2,
      "productName"=> $product_invoice[$i]["name"],
      "productId"=> $product_invoice[$i]["fiken_id"],
      "description"=> "Goatskin, with extra-long suede cuffs",
      "comment"=> "One size fits all",
      "incomeAccount"=> $product_invoice[$i]["code"]
    ];
}
  //dd($sub_data);
$data = ["uuid"=> "123e4567-e89b-12d3-a456-426655440000",
    "issueDate"=> "2020-12-20",
    "dueDate"=> "2020-12-20",
    "lines"=> $sub_data,
  "customerId"=> $customer_id->fiken_cus_id,
  "bankAccountCode"=> "1920:10001",
  "currency"=> "NOK",
  "invoiceText"=> "Invoice for services rendered during the Oslo Knitting Festival.",
  "cash"=> true,
  "paymentAccount"=> "1920:10001",
];
                    

    $chz = curl_init("https://api.fiken.no/api/v2/companies/fiken-demo-venstre-vik-as/invoices"); 
                                $data = json_encode($data);
                                $authorization = "Authorization: Bearer 1688894217.hBpAwTwLZjUp4XvPgDPnQUZSk4FiWzs8"; 
                                curl_setopt($chz, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json' , $authorization )); 
                                curl_setopt($chz, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($chz, CURLOPT_POST, 1); 
                                curl_setopt($chz, CURLOPT_HEADER, true);
                                curl_setopt($chz, CURLOPT_CUSTOMREQUEST, "POST");
                                curl_setopt($chz, CURLOPT_POSTFIELDS, $data); 
                                curl_setopt($chz, CURLOPT_FOLLOWLOCATION, false); 
                                $resultz = curl_exec($chz); 
                                //dd($resultz);
                                
                                $header_size = curl_getinfo($chz);
                                $headers = substr($resultz, 0, $header_size["header_size"]); //split out header
                                //dd($headers);

                                preg_match("!\r\n(?:location|URI): *(.*?) *\r\n!", $headers, $matches);
                                $url = $matches[1];
                                    
                               
                                //curl_close($chz);
                                //dd($resultz);
                                

                                $array_url = explode('/',$url);
                                $final_array = array_reverse($array_url);

                                //Get Fiken Generated Inoice
                                $curl = curl_init();
                                curl_setopt_array($curl, array(
                                CURLOPT_URL => "https://api.fiken.no/api/v2/companies/fiken-demo-venstre-vik-as/invoices/".$final_array[0],
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
                                //dd($response);

                                $order = Order::where(['id'=>$id])->update
                                    ([
                                        'fiken_invoice_id' => $final_array[0],
                                        'invoice_url'=> $response->invoicePdf->downloadUrl,
            
                                    ]);
                                    //dd($final_array); 
                return redirect()->back()->with('flash_message_success','Invoice Created Successfully');
                                
}
public function viewInvoice($id)
{
    $invoice_link = DB::table('orders')->where(['id'=>$id])->first();
    //dd($invoice_link);
    $url = $invoice_link->invoice_url;
    //dd($url);
    $name = explode('/', $url);
    $name_reverse = array_reverse($name);
    $file_name = $name_reverse[0];
    //dd($file_name);
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_POSTFIELDS => array('username' => 'post@kjottsentralen.no','password' => 'Kswwqq2018'),
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer 1688894217.hBpAwTwLZjUp4XvPgDPnQUZSk4FiWzs8',
    'Content-Type: application/pdf'
  ),
));

$response = curl_exec($curl);
header('Cache-Control: public'); 
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="'.$file_name.'"');
header('Content-Length: '.strlen($response));
echo $response;
curl_close($curl);
}
}
