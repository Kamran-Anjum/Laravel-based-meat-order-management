<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\Supplier;
use App\Models\Supplierproducts;
use Auth;
use Image;
class SupplierController extends Controller
{
    public function viewSuppliers()
    {
    	$suppliers = DB::table('suppliers as s')
    	->join('users as u','s.created_by', '=', 'u.id')
    	->select('s.*','u.name as userName')
    	->get();
    	return view('admin.suppliers.view-suppliers')->with(compact('suppliers'));
    }

    public function createSupplier(Request $request)
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
            if($request->hasFile('image')){

                $image_tmp = $request->image;
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = 'supplier'.rand(1111,9999999).'.'.$extension;
                        $large_image_path = 'images/backend-images/halalmeat/supplier/large/'.$filename;
                        $medium_image_path = 'images/backend-images/halalmeat/supplier/medium/'.$filename;
                        $small_image_path = 'images/backend-images/halalmeat/supplier/small/'.$filename;
                        $tiny_image_path = 'images/backend-images/halalmeat/supplier/tiny/'.$filename;
                        Image::make($image_tmp)->save($large_image_path);
                        Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(166,266)->save($small_image_path);
                        Image::make($image_tmp)->resize(100,100)->save($tiny_image_path);
                        $supplier->image = $filename;
                    }
                }
            $supplier->save();
            /*return redirect()->back()->with('flash_message_success','Product Added Successfully!');*/
            return redirect('/admin/view-suppliers')->with('flash_message_success','Supplier Added Successfully!');
        }
        $countries = DB::table('cities')->get();
    	$country_dropdown = "<option disabled selected > Select Category</option>";

    	foreach ($countries as $country) {
    		$country_dropdown .="<option value='".$country->id."'>".$country->name . "</option>";
    	}
        
        return view('admin.suppliers.create-supplier')->with(compact('country_dropdown'));
    }

    public function editSupplier(Request $request, $id = null){
        
        $user = Auth::user();
        $user_id = $user->id;

        if($request->isMethod('post')){
            $data = $request->all();
            
            if($request->hasFile('image')){

                $image_tmp = $request->image;
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = 'supplier'.rand(1111,9999999).'.'.$extension;
                        $large_image_path = 'images/backend-images/halalmeat/supplier/large/'.$filename;
                        $medium_image_path = 'images/backend-images/halalmeat/supplier/medium/'.$filename;
                        $small_image_path = 'images/backend-images/halalmeat/supplier/small/'.$filename;
                        $tiny_image_path = 'images/backend-images/halalmeat/supplier/tiny/'.$filename;
                        Image::make($image_tmp)->save($large_image_path);
                        Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(166,266)->save($small_image_path);
                        Image::make($image_tmp)->resize(100,100)->save($tiny_image_path);
                    }
                }
                else{
                    $filename = $data['current_image'];
                if( empty($filename)){
                    $filename ='';
                }
                }
            Supplier::where(['id'=>$id])->update
            ([
                'supplier_name' => $data['supplier_name'],
                'contact_no' => $data['supplier_cell'],
                'email' => $data['supplier_email'],
                'country_id' => $data['country_id'],
                'city_id' => $data['city'],
                'address' => $data['s_address'],
                'updated_by' => $user_id,
                'image' => $filename,
                'is_active' => $data['is_active']
            
            ]);
        return redirect('/admin/view-suppliers')->with('flash_message_success','Supplier has been Updated Successfully!'); 
        }
        $supplier = DB::table('suppliers as s')
        ->where(['s.id'=>$id])
        ->select('s.*')
        ->first();
        //dd($courseType);

        $cities = DB::table('cities')->get();

        $city_dropdown = "<option value=''>Select City</option>";
         foreach($cities as $country){
            if($supplier->city_id == $country->id){
            $city_dropdown .= "<option selected value='".$country->id."'>".$country->name . "</option>";
            }
            else{
            $city_dropdown .= "<option value='".$country->id."'>".$country->name  . "</option>";
            }
         }
        return view('admin.suppliers.edit-supplier')->with(compact('supplier','city_dropdown'));
    }

    public function viewSupplierProduct($id)
    {
    	$supplier_id = $id;
    	$sup_products = DB::table('supplier_products as sp')
    	->where(['sp.supplier_id' => $id])
    	->join('products as p','sp.product_id','=','p.id')
    	->join('suppliers as s','sp.supplier_id','=','s.id')
    	->join('users as u','s.created_by', '=', 'u.id')
    	->select('sp.*','s.supplier_name as suppName','p.name as productName','u.name as userName')
    	->get();
    	return view('admin.suppliers.suppliers-products.view-supproducts')->with(compact('sup_products','supplier_id'));
    }

    public function createSupplierProduct(Request $request, $id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        if($request->isMethod('post'))
        {
            $data = $request->all();

            for ($i=0; $i <count($data['supp_products']) ; $i++) { 
            	$supplierproduct = new Supplierproducts();
            	$supplierproduct->supplier_id = $data['supplier_id'];
            	$supplierproduct->product_id = $data['supp_products'][$i];
            	$supplierproduct->created_by = $user_id;
            	$supplierproduct->save();
            }
            
            //return redirect()->back()->with('flash_message_success','Product Added To Supplier Successfully!');
            return redirect('/admin/view-supplier-products/'.$id)->with('flash_message_success','Product Added To Supplier Successfully!');
        }
        $supplier = DB::table('suppliers')->where(['id'=>$id])->first();
        $products = DB::table('products as p')
        ->where(['is_active'=>1])
		->join('categories as c','p.category_id','=','c.id')
		->select('p.*','c.name as catName')
        ->get();
        
        return view('admin.suppliers.suppliers-products.create-supproduct')->with(compact('supplier','products'));
    }

    public function deleteSupplierProduct($id)
    {
    	Supplierproducts::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Pdoruct has been deleted Successfully From Supplier!');
    }
    public function deleteSupplier($id)
    {	Supplier::where(['id' => $id])->delete();
    	Supplierproducts::where(['supplier_id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Supplier been deleted Successfully!');
    }

    public function deletesupplierimage($id)
    {
        Supplier::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('flash_message_success','Supplier image has been Deleted Successfully!');
    }
}
