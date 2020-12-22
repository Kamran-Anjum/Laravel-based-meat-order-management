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
        return redirect('/admin')->with('flash_message_success','Logged out Successfully');
    }

    /*starts order controlling functions*/

    public function viewOrders(){

    	$orders = DB::table('orders as o')
    	->whereIn('status', [8,11,12,14])
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

            return redirect('/packing/view-orders')->with('flash_message_success','Order Status has been Updated Successfully!');
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

        $order_status = DB::table('purchase_order_status')->whereIn('id',[11, 13])->get();
        //dd($order_status);
        $status_dropdown = "<option selected >Select New Status</option>";
        foreach ($order_status as $status) {
        	
        		$status_dropdown .= "<option value='".$status->id."'>".$status->name."</option>";
        	
        }
        $location_status = DB::table('order_location_status')->whereNotIn('id',[1,2,5])->get();
        //dd($order_status);
        $location_dropdown = "<option selected >Department To Froward</option>";
        foreach ($location_status as $loc_status) {
        	
        		$location_dropdown .= "<option value='".$loc_status->id."'>".$loc_status->name."</option>";
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
        return view('departments.packing.purchaseorder.view-purchase-orders')->with(compact('purchase_orders'));
        }
        else{
            return redirect('/packing');
        }
        
    }

    public function recievePurchaseOrders(Request $request)
    {
        $user = Auth::User();
        if (!empty($user)) {
            if($request->isMethod('post'))
            {
                $data = $request->all();
                //dd($data);

                PurchaseOrder::where(['id'=>$data['po_id']])->update
                    ([
                    'total_amount' => $data['totalamount'],
                    'updated_by' => $user->id,
                    'status' => $data['status'],
                    'recieve_note' => $data['recieve_note'],
            
                    ]);

                for ($i=0; $i <count($data['pod_id']) ; $i++) { 
                PurchaseOrderDetail::where(['id'=>$data['pod_id'][$i]])->update
                ([
                    'price' => $data['price'][$i],
                    'recieved_quantity' => $data['rquantity'][$i],
                    'total_amount' => $data['tamount'][$i],
                    'recieved_by' => $user->id,
            
                ]);

                }
                //$check = [];
                for ($i=0; $i <count($data['productid']) ; $i++) { 
                        
                        $products = DB::table('product_stocks')
                        ->where(['product_id'=> $data['productid'][$i]])
                        ->first();

                        if (!empty($products)) {
                            //$check[] .= "not empty";
                            $recqty = $data['rquantity'][$i] + $products->recieve_qty;
                            $balqty = $data['rquantity'][$i] + $products->balanced_qty;
                            ProductStock::where(['product_id'=>$data['productid'][$i]])->update
                            ([
                                'recieve_qty' => $recqty,
                                'balanced_qty' => $balqty,
            
                            ]);
                        }
                        else{
                            $add_product_stock = new ProductStock();
                            $add_product_stock->product_id = $data['productid'][$i];
                            $add_product_stock->recieve_qty = $data['rquantity'][$i];
                            $add_product_stock->sale_qty = 0;
                            $add_product_stock->balanced_qty = $data['rquantity'][$i];
                            $add_product_stock->save();
                        }
                }
                //dd($check);
                return redirect('/packing/view-pruchase-orders')->with('flash_message_success','P.O #'.$data['po_id'].' Recieved Successfully!');
            }

            $purchase_orders = DB::table('purchase_order as po')
            ->where(['status'=> 1])
            ->join('suppliers as s','po.supplier_id','=','s.id')
            ->select('po.*','s.supplier_name as suppName')
            ->get();

            $po_dropdown = "<option disabled selected > Select PO #</option>";

        foreach ($purchase_orders as $purchase_order) {
            $po_dropdown .="<option value='".$purchase_order->id."'>P.O.#".$purchase_order->id ."(".$purchase_order->suppName.")</option>";
        }
        
        return view('departments.packing.purchaseorder.recieve-purchase-order')->with(compact('po_dropdown'));
        }
        else{
            return redirect('/admin');
        }
        
    }

    public function createPDF($id) {
      // retreive all records from db
      $purchase_orders = DB::table('purchase_order as po')
      ->where(['po.id'=>$id])
            ->join('suppliers as s','po.supplier_id','=','s.id')
            //->join('purchase_order_detail as pod','po.id','=','pod.p_order_id')
            //->join('products as p','pod.product_id','=','p.id')
            ->join('users as u','po.created_by', '=', 'u.id')
            ->join('purchase_order_status as pos','po.status','=','pos.id')
            ->select('po.*','s.address as saddress','s.email as semail','s.supplier_name as suppName','u.name as userName','pos.name as status')
            ->get();

      // share data to view
      view()->share('purchase_orders',$purchase_orders);
      $pdf = PDF::loadView('departments.packing.purchaseorder.po-invoice', $purchase_orders);
      

      // download PDF file with download method
      return $pdf->stream('invoice_po_'.$id.'.pdf');
    }
}
