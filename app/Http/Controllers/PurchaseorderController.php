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
    		->select('po.*','s.supplier_name as suppName','u.name as userName')
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
            $PO->status = $data['periority'];
            $PO->save();
            $po_id = $PO->id;

            for ($i=0; $i <count($data['products_id']) ; $i++) { 
            	$POD = new PurchaseOrderDetail();
            	$POD->p_order_id = $po_id;
            	$POD->product_id = $data['products_id'][$i];
            	$POD->demand_quantity = $data['quantity'][$i];
            	$POD->save();
            }
            /*return redirect()->back()->with('flash_message_success','Product Added Successfully!');*/
            return redirect('/admin/view-pruchase-orders')->with('flash_message_success','Supplier Added Successfully!');
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
}
