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

                $subcategories_dropdown = "";
                foreach($subcategories as $subcategory){
                    $subcategories_dropdown .= "<option value='".$subcategory->id."'>".$subcategory->name . "</option>";      
                     }
        
        
        return $subcategories_dropdown;

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

    public function getCustomerDetail($id = null){

        $authorizedRoles = ['internal customer', 'external customer', 'private customer','workforce'];

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
            //->join('purchase_order_detail as pod','po.id','=','pod.p_order_id')
            //->join('products as p','pod.product_id','=','p.id')
            ->join('countries as c','sc.country_id','=','c.id')
            ->join('states as s','sc.state_id','=','s.id')
            ->join('cities as ct','sc.city_id','=','ct.id')
            ->join('users as u','po.created_by', '=', 'u.id')
            ->select('po.*','sc.*','ct.name as cityname','s.name as statename','c.name as country','u.name as userName')
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

        $po_status = DB::table('purchase_order_status')->whereNotIn('id',[1])->get();
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
}
