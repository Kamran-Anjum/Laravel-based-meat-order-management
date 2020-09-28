<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
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

    public function recievePurchaseOrders()
    {
    	$user = Auth::User();
    	if (!empty($user)) {
    		$purchase_orders = DB::table('purchase_order as po')
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
