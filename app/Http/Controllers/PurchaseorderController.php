<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\ProductStock;
use App\Models\ProductStockRecieve;
use App\Models\Product;
use Auth;
use Image;
use PDF;

class PurchaseorderController extends Controller
{
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
    		->select('po.*','s.supplier_name as suppName','u.name as userName','pos.name as status','pps.name as prStatus')
    		->get();
    	return view('admin.purchaseorder.view-purchase-orders')->with(compact('purchase_orders'));
    	}
    	else{
    		return redirect('/admin');
    	}
    	
    }

    public function createPurchaseOrder(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //dd($data);
            $PO = new PurchaseOrder();
            $PO->supplier_id = $data['supplier_id'];
            $PO->created_by = $user_id;
            $PO->order_note = $data['order_note'];
            $PO->status = 1;
            $PO->pr_status = $data['periority'];
            $PO->save();
            $po_id = $PO->id;

            for ($i=0; $i <count($data['products_id']) ; $i++) { 
            	$POD = new PurchaseOrderDetail();
            	$POD->p_order_id = $po_id;
            	$POD->product_id = $data['products_id'][$i];
            	$POD->demand_quantity = $data['quantity'][$i];
                $POD->price = $data['price'][$i];
                $POD->total_amount = $data['quantity'][$i] * $data['price'][$i];
            	$POD->save();
            }
            /*return redirect()->back()->with('flash_message_success','Product Added Successfully!');*/
            return redirect('/admin/view-pruchase-orders')->with('flash_message_success','P.O Added Successfully!');
        }
        $suppliers = DB::table('suppliers')->where(['is_active' => 1])->get();
    	$supplier_dropdown = "<option disabled selected > Select Supplier</option>";

    	foreach ($suppliers as $supplier) {
    		$supplier_dropdown .="<option value='".$supplier->id."'>".$supplier->supplier_name . "</option>";
    	}
        
        return view('admin.purchaseorder.create-purchase-order')->with(compact('supplier_dropdown'));
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
                return redirect('/admin/view-pruchase-orders')->with('flash_message_success','P.O #'.$data['po_id'].' Recieved Successfully!');
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
        
    	return view('admin.purchaseorder.recieve-purchase-order')->with(compact('po_dropdown'));
    	}
    	else{
    		return redirect('/admin');
    	}
    	
    }

    public function editPurchaseOrders(Request $request,$id)
    {
        $user = Auth::User();
        if (Auth::check()) {
            if($request->isMethod('post'))
            {
                $data = $request->all();
                //dd($data);
                $checkpolength = PurchaseOrderDetail::where(['p_order_id'=>$id])->get();
                if (count($checkpolength) < count($data['products_id'])) {
                    PurchaseOrder::where(['id'=>$id])->update
                    ([
                    'pr_status' => $data['periority'],
                    'order_note' => $data['order_note'],
            
                    ]);
                    for ($i=0; $i <count($data['products_id']) ; $i++) { 
                        if (isset($checkpolength[$i]["product_id"]) != $data["products_id"][$i]) {
                            PurchaseOrderDetail::where(['id'=>$data['pod_id'][$i]])->update
                            ([
                                'price' => $data['price'][$i],
                                'demand_quantity' => $data['quantity'][$i],
                                'total_amount' => $data['quantity'][$i] * $data['price'][$i],
            
                            ]);
                            $POD = new PurchaseOrderDetail();
                            $POD->p_order_id = $data['poid'];
                            $POD->product_id = $data['products_id'][$i];
                            $POD->demand_quantity = $data['quantity'][$i];
                            $POD->price = $data['price'][$i];
                            $POD->total_amount = $data['quantity'][$i] * $data['price'][$i];
                            $POD->save();
                        }
                        else{
                            PurchaseOrderDetail::where(['id'=>$data['pod_id'][$i]])->update
                            ([
                                'price' => $data['price'][$i],
                                'demand_quantity' => $data['quantity'][$i],
                                'total_amount' => $data['quantity'][$i] * $data['price'][$i],
            
                            ]);
                        }
                    }
                    return redirect('/admin/view-pruchase-orders')->with('flash_message_success','P.O Edited Successfully!');
                }
                else{
                PurchaseOrder::where(['id'=>$id])->update
                    ([
                    'pr_status' => $data['periority'],
                    'order_note' => $data['order_note'],
            
                    ]);

                PurchaseOrderDetail::where(['p_order_id'=>$id])
                ->whereNotIn('product_id',$data['products_id'])->delete();

                
                for ($i=0; $i <count($data['pod_id']) ; $i++) { 

                PurchaseOrderDetail::where(['id'=>$data['pod_id'][$i]])->update
                ([
                    'price' => $data['price'][$i],
                    'demand_quantity' => $data['quantity'][$i],
                    'total_amount' => $data['quantity'][$i] * $data['price'][$i],
            
                ]);

                }
            }
                //dd($data);
                return redirect('/admin/view-pruchase-orders')->with('flash_message_success','P.O Edited Successfully!');
            }

            $po = DB::table('purchase_order as po')
            ->where(['po.id'=> $id])
            ->where(['po.status'=> 1])
            ->join('suppliers as s','po.supplier_id','=','s.id')
            ->join('po_priority_status as pos','po.pr_status','=','pos.id')
            ->select('po.*', 's.supplier_name as suppName','pos.id as pr_id')
            ->first();

            $purchase_orders_detail = DB::table('purchase_order_detail')
            ->where(['p_order_id'=> $id])
            ->get();

             $supplier_products = DB::table('supplier_products as sp')
             ->where(['sp.supplier_id'=> $po->supplier_id])
             ->join('products as p','sp.product_id','=','p.id')
             ->select('p.name as prodname','sp.*')
             ->get();
             $proid = [];
             foreach ($purchase_orders_detail as $value) {
                 $proid[] .= $value->product_id;
             }
             //dd($proid);
             //dd($produtcs,$purchase_orders_detail);
             $y = 0;
             $product_dropdown = "";
            foreach($supplier_products as $product){
                if (isset($proid[$y])) {
                   if($product->product_id == $proid[$y]){
                        $product_dropdown .= "<option selected value='".$product->product_id."'>".$product->prodname . "</option>";
                }
            }
            else{
            $product_dropdown .= "<option value='".$product->product_id."'>".$product->prodname  . "</option>";
            }
                
            $y = $y+1;
         }
         //dd($product_dropdown);
            $pr_statuses = DB::table('po_priority_status')->get();

            $pr_statuses_dropdown = "";
            foreach($pr_statuses as $pr_statuse){
            if($po->pr_status == $pr_statuse->id){
            $pr_statuses_dropdown .= "<option selected value='".$pr_statuse->id."'>".$pr_statuse->name . "</option>";
            }
            else{
            $pr_statuses_dropdown .= "<option value='".$pr_statuse->id."'>".$pr_statuse->name  . "</option>";
            }
         }
            
            if(count($purchase_orders_detail) == 0){
                return redirect('/admin/view-pruchase-orders')->with('flash_message_success','Cannot Edit "Recieved" Purchase Order');
                
            }
            else{
                //dd($purchase_orders_detail);
                return view('admin.purchaseorder.edit-purchase-order')->with(compact('purchase_orders_detail','po','pr_statuses_dropdown','product_dropdown'));
            }
        
        
        }
        else{
            return redirect('/admin');
        }
        
    }

    // Generate PDF
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
      $pdf = PDF::loadView('admin.purchaseorder.po-invoice', $purchase_orders);
      

      // download PDF file with download method
      return $pdf->stream('invoice_po_'.$id.'.pdf');
    }
}
