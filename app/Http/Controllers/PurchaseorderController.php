<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\PurchaseOrder;
use Auth;
use Image;

class PurchaseorderController extends Controller
{
    public function viewPurchaseOrders()
    {
    	$purchase_orders = DB::table('purchase_order as po')
    	->join('suppliers as s','po.supplier_id','=','s.id')
    	->join('products as p','po.product_id','=','p.id')
    	->join('users as u','po.created_by', '=', 'u.id')
    	->select('po.*','s.supplier_name as suppName','p.name as productName','u.name as userName')
    	->get();
    	return view('admin.purchaseorder.view-purchase-orders')->with(compact('purchase_orders'));
    }

    public function createPurchaseOrder(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $supplier = new Supplier();
            $supplier->supplier_name = $data['supplier_name'];
            $supplier->contact_no = $data['supplier_cell'];
            $supplier->email = $data['supplier_email'];
            $supplier->country_id = $data['country_id'];
            $supplier->state_id = $data['state'];
            $supplier->city_id = $data['city'];
            $supplier->address = $data['s_address'];
            $supplier->created_by = $user_id;
            $supplier->is_active = $data['is_active'];
            $supplier->save();
            /*return redirect()->back()->with('flash_message_success','Product Added Successfully!');*/
            return redirect('/admin/view-suppliers')->with('flash_message_success','Supplier Added Successfully!');
        }
        $suppliers = DB::table('suppliers')->where(['is_active' => 1])->get();
    	$supplier_dropdown = "<option disabled selected > Select Supplier</option>";

    	foreach ($suppliers as $supplier) {
    		$supplier_dropdown .="<option value='".$supplier->id."'>".$supplier->supplier_name . "</option>";
    	}
        
        return view('admin.purchaseorder.create-purchase-order')->with(compact('supplier_dropdown'));
    }
}
