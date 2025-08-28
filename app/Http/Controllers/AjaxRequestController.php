<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\State;
use App\Models\City;
use App\Models\User;


class AjaxRequestController extends Controller
{
	//Get Subcategories
    public function getsubcategoriesdropdown($id = null){

        $subcategories = DB::table('subcategories')
                ->whereIn('category_id',array($id))->get();

                $subcategories_dropdown = "<option disabled selected>Select Sub Category</option>";
                foreach($subcategories as $subcategory){
                    $subcategories_dropdown .= "<option value='".$subcategory->id."'>".$subcategory->name . "</option>";      
                     }
        
        
        return $subcategories_dropdown;

    }
    //Get Assets Subcategories
    public function getassetsubcategoriesdropdown($id = null){

        $subcategories = DB::table('assets_subcategories')
                ->whereIn('asset_category_id',array($id))->get();

                $subcategories_dropdown = "<option disabled selected>Select Sub Category</option>";
                foreach($subcategories as $subcategory){
                    $subcategories_dropdown .= "<option value='".$subcategory->id."'>".$subcategory->name . "</option>";      
                     }
        
        
        return $subcategories_dropdown;

    }
    //Get Products for sales Order
    public function getproductsdropdown($id = null){

        $subcategories = DB::table('product_sub_categories as ps')
                ->where(['ps.subcategory_id'=>$id])
                ->join('products as p','p.id','=','ps.product_id')
                ->select('p.*')
                ->get();

                $products_dropdown = "<option disabled selected>Select Product</option>";
                foreach($subcategories as $subcategory){
                    $products_dropdown .= "<option value='".$subcategory->id."'>".$subcategory->name . "</option>";      
                     }
        
        
        return array($subcategories,$products_dropdown);

    }
    
    //Get gustomer Details
    public function getcustomerdetailsnyIdform($id = null){

        $customerDetail = DB::table('users as u')
                ->where(['u.id'=>$id])
                ->join('customer_details as c','u.id','=','c.user_id')
                ->select('u.name as userName','u.email as userEmail','c.address as customerAddress','c.cell_no as cellNumber')
                ->first();

            $username = $customerDetail->userName;
            $useremail = $customerDetail->userEmail;
            $useraddress = $customerDetail->customerAddress;
            $usercell = $customerDetail->cellNumber;
        return array($username,$useremail,$useraddress,$usercell);

    }
    
    //Get Products Stock $ Sale Price for sales Order
    public function getproductstockprice($id, $cusid){

        $stocks = DB::table('product_stocks')
                ->where(['product_id'=>$id])
                ->first();
        $balance_stock = $stocks->recieve_qty - $stocks->sale_qty;

        $authorizedRoles = ['internal-customer', 'external-customer', 'private-customer','workforce'];
        
        $users = User::whereHas('roles', static function ($query) use ($authorizedRoles) {
                    return $query->whereIn('name', $authorizedRoles);
                })->where(['id'=>$cusid])->with('roles')->first();

        $role_id = $users->roles->first()->id;
        $customer_sale_price = DB::table('customer_price')
                                ->where(['role_id'=>$role_id])
                                ->first();
        $products = DB::table('products as p')
        ->where(['p.id'=>$id])
        ->join('product_unit as pu','p.unit','=','pu.id')
        ->select('p.*','pu.name as unitName')
        ->first();

        $base_price_percent = $products->base_price/100*$customer_sale_price->price_percent;

        $sales_price = $products->base_price + $base_price_percent;

        $unit = $products->unitName;
        
        
        return array($balance_stock,$sales_price,$unit);

    }
    //Get Supplier Product for Purchase Order
    public function getSupplierproductPO($id = null){

        $supplier_product_ids = DB::table('supplier_products')
                ->where(['supplier_id' => $id])->get();
        $product_ids = [];

        foreach ($supplier_product_ids as $value) {
            $product_ids[] .= $value->product_id;
        }
        $products = DB::table('products')
                ->whereIn('id',$product_ids)->get();
                $products_dropdown = "";
                foreach($products as $product){
                    $products_dropdown .= "<option data='".$product->name."' value='".$product->id."'>".$product->name . "</option>";      
                     }
        
        
        return $products_dropdown;

    }
    //Get State Names
    public function getStateName($id)
	{
		$states = State::where(['country_id'=>$id, 'is_active'=>1])->get();
		return $states;
	}
    //Get Cities Name
	public function getCityName($cid, $id)
	{
		$cities = City::where(['country_id'=>$cid, 'states_id'=>$id, 'is_active'=>1])->get();
		return $cities;
	}

    //Get Supplier Details
	public function getSupplierDetail($id = null){

        $suppliers = DB::table('suppliers as sc')
            ->where(['sc.id' => $id])
            ->join('countries as c','sc.country_id','=','c.id')
            ->join('states as s','sc.country_id','=','s.id')
            ->join('cities as ct','sc.city_id','=','ct.id')
            ->join('users as u','sc.created_by','=','u.id')
            ->select('sc.*','u.name as userName','c.name as country','s.name as statename','ct.name as cityname')
            // ->groupBy('sc.batch_id')
            ->first();
            $supp_detail = "<tr class='gradeX'><td><strong>Supplier Name:  </strong>".$suppliers->supplier_name."</td></tr><tr class='gradeX'><td><strong>Supplier Contact No:  </strong>".$suppliers->contact_no."</td></tr><tr class='gradeX'><td><strong>Supplier Email:  </strong>".$suppliers->email."</td></tr><tr class='gradeX'><td><strong>Supplier Address:  </strong>".$suppliers->address."</td></tr><tr class='gradeX'><td><strong>Supplier City:  </strong>".$suppliers->cityname."</td></tr><tr class='gradeX'><td><strong>Supplier Country:  </strong>".$suppliers->country."</td></tr><tr class='gradeX'><td><strong>Supplier Created By:  </strong>".$suppliers->userName."</td></tr><tr class='gradeX'><td><strong>Status:  </strong>Active</td></tr><tr class='gradeX'><td><strong>Supplier Image:  </strong><img src='https://halalmeat.testit.live/images/backend-images/halalmeat/supplier/tiny/".$suppliers->image."'</td></tr><tr class='gradeX'><td><strong>Created At:  </strong>".$suppliers->created_at."</td></tr>";
        return $supp_detail;

    }
    //Get Assets Details
    public function getAssetDetail($id = null){

        $assets = DB::table('assets as a')
            ->where(['a.id' => $id])
            ->join('assets_vehicle_details as av','a.id','=','av.asset_id')
            ->join('assets_status as aa','a.status','=','aa.id')
            ->join('users as u','a.created_by','=','u.id')
            ->join('assets_categories as ac','a.asset_category_id','=','ac.id')
            ->join('assets_subcategories as asc','a.asset_subcategory_id','=','asc.id')
            ->select('a.*','av.*','aa.name as statuses','u.name as userName','ac.name as catName','asc.name as subcatName')
            // ->groupBy('sc.batch_id')
            ->first();
            $supp_detail = "<tr class='gradeX'><td><strong>Category Name:  </strong>".$assets->catName."</td></tr><tr class='gradeX'><td><strong>Sub-Category Name:  </strong>".$assets->subcatName."</td></tr><tr class='gradeX'><td><strong>Asset Name:  </strong>".$assets->name."</td></tr><tr class='gradeX'><td><strong>Document No.:  </strong>".$assets->document_no."</td></tr><tr class='gradeX'><td><strong>Amount:  </strong> $ ".$assets->cost_amount  ."</td></tr><tr class='gradeX'><td><strong>Tax:  </strong> $ ".$assets->tax_amount."</td></tr><tr class='gradeX'><td><strong>Total Amount:  </strong> $ ".$assets->total_amount."</td></tr><tr class='gradeX'><td><strong>Created By:  </strong>".$assets->userName."</td></tr><tr class='gradeX'><td><strong>Status:  </strong>".$assets->statuses."</td></tr><tr class='gradeX'><td><strong>Registeration No:  </strong>".$assets->reg_no."</td></tr><tr class='gradeX'><td><strong>Engine No:  </strong>".$assets->engine_no."</td></tr><tr class='gradeX'><td><strong>Chasis No:  </strong>".$assets->chasis_no."</td></tr><tr class='gradeX'><td><strong>Asset Image:  </strong><img src='http://127.0.0.1:8000/images/backend-images/halalmeat/assets/vehicle/tiny/".$assets->image."'</td></tr><tr class='gradeX'><td><strong>Created At:  </strong>".$assets->created_at."</td></tr>";
        return $supp_detail;

    }

    public function getCustomerDetail($id = null){

        $authorizedRoles = ['internal-customer', 'external-customer', 'private-customer','workforce','Rider'];

        $users = User::whereHas('roles', static function ($query) use ($authorizedRoles) {
                    return $query->whereIn('name', $authorizedRoles);
                })->where(['id'=>$id])->with('roles')->first();

        $ud = DB::table('customer_details')->where(['user_id'=>$id])->first();

            $user_detail = "<tr class='gradeX'><td><strong>Customer Name:  </strong>".$users->name."</td></tr><tr class='gradeX'><td><strong>Customer Email:  </strong>".$users->email."</td></tr><tr class='gradeX'><td><strong>Organization No:  </strong>".$ud->organization_no."</td></tr><tr class='gradeX'><td><strong>Contact Person Name:  </strong>".$ud->contact_person_name."</td></tr><tr class='gradeX'><td><strong>Customer Role:  </strong>".$users->roles->first()->name."</td></tr><tr class='gradeX'><td><strong>Customer Cell No:  </strong>".$ud->cell_no."</td></tr><tr class='gradeX'><td><strong>Customer Address:  </strong>".$ud->address."</td></tr><tr class='gradeX'><td><strong>Profile Image:  </strong><img src='https://halalmeat.testit.live/images/backend-images/halalmeat/customer/tiny/".$ud->profile_image."'</td></tr>";
        return $user_detail;

    }

    public function getRiderDetail($id = null){

        $authorizedRoles = ['internal customer', 'external customer', 'private customer','workforce','Rider'];

        $users = User::whereHas('roles', static function ($query) use ($authorizedRoles) {
                    return $query->whereIn('name', $authorizedRoles);
                })->where(['id'=>$id])->with('roles')->first();

        $ud = DB::table('customer_details')->where(['user_id'=>$id])->first();

            $user_detail = "<tr class='gradeX'><td><strong>Customer Name:  </strong>".$users->name."</td></tr><tr class='gradeX'><td><strong>Customer Email:  </strong>".$users->email."</td></tr><tr class='gradeX'><td><strong>Customer Role:  </strong>".$users->roles->first()->name."</td></tr><tr class='gradeX'><td><strong>Customer Cell No:  </strong>".$ud->cell_no."</td></tr><tr class='gradeX'><td><strong>Customer Address:  </strong>".$ud->address."</td></tr><tr class='gradeX'><td><strong>Profile Image:  </strong><img src='https://halalmeat.testit.live/images/backend-images/halalmeat/customer/tiny/".$ud->profile_image."'</td></tr>";
        return $user_detail;

    }

    //Get Post Order Details
    public function getPODetail($id = null){

        $purchase_orders = DB::table('purchase_order as po')
            ->where(['po.id'=> $id])
            ->join('suppliers as sc','po.supplier_id','=','sc.id')
            ->join('countries as c','sc.country_id','=','c.id')
            ->join('cities as ct','sc.city_id','=','ct.id')
            ->join('users as u','po.created_by', '=', 'u.id')
            ->select('po.*','sc.*','ct.name as cityname','c.name as country','u.name as userName')
            ->first();

        $po_detail = DB::table('purchase_order_detail as pod')
        ->where(['pod.p_order_id'=> $id])
        ->join('products as p','pod.product_id','=','p.id')
        ->select('pod.*','p.name as productName')
        ->get();

            $supp_detail = "<h3>PO # ".$id."</h3><h3>Supplier Info</h3><tr class='gradeX'><td><strong>Supplier Name:  </strong>".$purchase_orders->supplier_name."</td><td><strong>Supplier Contact No:  </strong>".$purchase_orders->contact_no."</td></tr>";

            $prod_detail = "<h2>Product Info</h2><tr><th>Product Name</th><th>Demand QTY</th><th>Rec. QTY</th><th>Price</th><th>Amount</th></tr>";

            foreach ($po_detail as $product) {
                $prod_detail .= "<tr><td>".$product->productName."</td><td>".$product->demand_quantity."</td><td>".$product->recieved_quantity."</td><td>".$product->price."</td><td>".$product->total_amount."</td></tr>";
            }
        return array($supp_detail,$prod_detail);

    }
    //Get Sales Order Details
    public function getSODetail($id = null){

        $sale_orders = DB::table('orders as o')
            ->where(['o.id'=> $id])
            ->join('po_priority_status as pos','o.priority_status','=','pos.id')
            ->join('purchase_order_status as ps','o.status','=','ps.id')
            ->join('order_location_status as ols','o.location_status','=','ols.id')
            ->join('users as u','o.created_by', '=', 'u.id')
            ->join('users as ou','o.user_id','=','ou.id')
            ->select('o.*','u.name as order_by','ou.name as customerName','ou.email as cusEmail','pos.name as pr_status','ps.name as s_status','ols.name as loc_status')
            ->first();

        $so_detail = DB::table('order_details as od')
        ->where(['od.order_id'=> $id])
        ->join('products as p','od.product_id','=','p.id')
        ->select('od.*','p.name as productName')
        ->get();

            $supp_detail = "<h3>SO # ".$id."</h3><h3>Sale Order Info</h3><tr class='gradeX'><td><strong>Customer Name:  </strong>".$sale_orders->customerName."</td><td><strong>Customer Eamil:  </strong>".$sale_orders->cusEmail."</td></tr><tr class='gradeX'><td><strong>Contact:  </strong>".$sale_orders->cell_no."</td><td><strong>Order Status:  </strong>".$sale_orders->s_status."</td></tr><tr class='gradeX'><td><strong>Shipp To:  </strong>".$sale_orders->shipping_address."</td><td><strong>Shipp From:  </strong>".$sale_orders->billing_address."</td></tr><tr class='gradeX'><td><strong>Priority:  </strong>".$sale_orders->pr_status."</td><td><strong>Location:  </strong>".$sale_orders->loc_status."</td></tr><tr class='gradeX'><td><strong>Total Amount:  </strong>".$sale_orders->total_amount."</td></tr>";
            $od_ids = [];
            $prod_detail = "<h3>ProductInfo<h3><tr><th>Name</th><th>Price</th><th>QTY</th><th>Discount</th><th>Amount</th><th>Sub Total</th></tr>";

            foreach ($so_detail as $product) {
                $od_ids[] .= $product->id;
                $prod_detail .= "<tr><td>".$product->productName."</td><td>".$product->unit_price."</td><td>".$product->quantity."</td><td>".$product->discount."</td><td>".$product->discount_amount."</td><td>".$product->total_price."</td></tr>";
            }

            $orderforward =  DB::table('forward_order_stock')->whereIn("order_detail_id",$od_ids)->get();
            if (count($orderforward) > 0) {
                $order_forward = DB::table('order_details as od')
                ->where(['od.order_id'=> $id])
                ->join('products as p','od.product_id','=','p.id')
                ->join('forward_order_stock as fos','od.id','=','fos.order_detail_id')
                ->select('od.*','p.name as productName','fos.forward_qty as forqty','fos.balance_qty as balqty')
                ->get();

                $forward_detail = "<h3>ForwardInfo<h3><tr><th>Name</th><th>Fowrwarded</th><th>Balance</th></tr>";

            foreach ($order_forward as $forward) {
                $forward_detail .= "<tr><td>".$forward->productName."</td><td>".$forward->forqty."</td><td>".$forward->balqty."</td></tr>";
            }
            }
            else{
                $forward_detail = "<h3>ForwardInfo<h3><tr><th>Name</th><th>Fowrwarded</th><th>Balance</th></tr><tr><td></td><td></td><td></td></tr>";
            }
            
        return array($supp_detail,$prod_detail,$forward_detail);

    }

    public function getRecievePO($id = null){

        $po_detail = DB::table('purchase_order_detail as pod')
        ->where(['pod.p_order_id'=> $id])
        ->join('products as p','pod.product_id','=','p.id')
        ->select('pod.*','p.name as productName','p.id as productid')
        ->get();

        $po = DB::table('purchase_order as po')
        ->where(['po.id'=> $id])
        ->join('purchase_order_status as pos','po.status','=','pos.id')
        ->join('po_priority_status as pop','po.pr_status','=','pop.id')
        ->select('po.*','pos.name as status','pos.id as posId','pop.name as prStatus')
        ->first();

        $po_status = DB::table('purchase_order_status')->whereIn('id',[2,3])->get();
        $pos_dropdown = "<option selected >Select Current Status </option>";
            foreach ($po_status as $statuses) {
                $pos_dropdown .= "<option value='".$statuses->id."'>".$statuses->name . "</option>";
            }
        return array($po_detail, $po, $pos_dropdown);

    }

    public function getPOproducts($id,$poid)
    {   
        
        $ids = array_map('intval', explode(',', $id));
        $podd = DB::table('purchase_order_detail as pod')
            ->whereIn('pod.product_id', $ids)
            ->where(['pod.p_order_id'=> $poid])
            ->join('products as p','pod.product_id','=','p.id')
            ->select('pod.*','p.name as prodName')
            ->get();

        return $podd;
    }

    public function getSummary($from,$to)
    {   

        if ($from == $to) {
            $sortdata = DB::table('orders')->whereDate('created_at',$from)->get();
            $porders = DB::table('purchase_order')->whereDate('created_at',$from)->get();
        }
        else{
            $sortdata = DB::table('orders')->whereBetween('created_at', [$from, $to])->get();
            $porders = DB::table('purchase_order')->whereBetween('created_at', [$from, $to])->get();
        }
        
        $sort_sales = 0;
        foreach ($sortdata as $value) {
            $sort_sales = $sort_sales+$value->total_amount;
        }

        
        $sort_purchase = 0;
        foreach ($porders as $pvalue) {
            $sort_purchase = $sort_purchase+$pvalue->total_amount;
        }
        

        return array($sort_sales,$sort_purchase,$sortdata);
    }

    public function CustomerByRolename($rolename){

        $user_by_roles = User::whereHas('roles', function ($q) use ($rolename) {
            $q->where('id', $rolename);
            })->get();

        $users_dropdown = "<option selected value='0' readonly>Select User</option>";
            foreach ($user_by_roles as $users) {
                $users_dropdown .= "<option value='".$users->id."'>".$users->name . "</option>";
            }
        return $users_dropdown;

    }

    public function ForwardStockSO($id)
    {
        $order_details = DB::table('order_details as od')
        ->where(['order_id'=> $id])
        ->join('products as p','od.product_id','=','p.id')
        ->select('od.*','p.name as productName')
        ->get();
        $forward_id = [];
        foreach ($order_details as $od) {
            $forward_id[] .= $od->id;
        }

        $order =  DB::table('forward_order_stock')->whereIn("order_detail_id",$forward_id)->get();
        if (count($order) > 0) {
            $order_detail = DB::table('order_details as od')
            ->where(['order_id'=> $id])
            ->join('products as p','od.product_id','=','p.id')
            ->join('forward_order_stock as fos','od.id','=','fos.order_detail_id')
            ->select('od.*','p.name as productName','fos.forward_qty','fos.balance_qty as balqty')
            ->get();
        }
        else{
            $order_detail = DB::table('order_details as od')
            ->where(['order_id'=> $id])
            ->join('products as p','od.product_id','=','p.id')
            ->select('od.*','p.name as productName')
            ->get();
        }

        return array($order_detail,$order);
    }
}
