<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Assetscategory;
use App\Models\AssetSubcategory;
use App\Models\Asset;
use App\Models\AssetVehicleDetail;
use Image;


class AssetsController extends Controller
{
	// Assets Category Functions Starts
    public function viewAssetsCategories()
    {
    	$assetcategories = DB::table('assets_categories as a')
    	->join('users as u','a.created_by','=','u.id')
    	->select('a.*','u.name as userName')
    	->get();

    	return view('admin.assets.assetscategories.view-categories')->with(compact('assetcategories'));
    }

    public function addAssetCategory(Request $request)
    {
    	$user = Auth::User();

    	if($request->isMethod('post')){
    		$data = $request->all();

    		$category = new Assetscategory();
    		$category->name = $data['cat_name'];
    		$category->created_by = $user->id;
    		$category->is_active = 1;
    		$category->save();

    		return redirect('admin/view-assets-categories')->with('flash_message_success','Assets Category successfully Added!');
    	}


    	return view('admin.assets.assetscategories.create-categories');
    }

    public function editAssetCategory(Request $request, $id =null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            Assetscategory::where(['id'=>$id])->update
            ([
                'name' => $data['cat_name'],
            ]);

            return redirect('/admin/view-assets-categories')->with('flash_message_success','Assets Category has been Updated Successfully!');
        }

        $categories = Assetscategory::where(['id'=>$id])->first();
        return view('admin.assets.assetscategories.edit-categories')->with(compact('categories'));
    }

    public function deleteCategory($id = null)
    {
        Assetscategory::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Assets Category has been deleted Successfully!');
    }
    // Assets Category Functions End

    // Assets Sub Category Functions Starts

    public function viewAssetsSubCategories(){

    	$assetsubcategories = DB::table('assets_subcategories as asc')
    	->join('assets_categories as ac','asc.asset_category_id','=', 'ac.id')
    	->join('users as u','asc.created_by', '=', 'u.id')
    	->select('asc.*','ac.name as catname','u.name as userName')
    	->get();

    	return view('admin.assets.assetssubcategories.view-subcategories')->with(compact('assetsubcategories'));
    }

    public function addAssetSubCategory(Request $request){
    	$user = Auth::User();

    	if($request->isMethod('post')){
    		$data = $request->all();

    		$category = new AssetSubcategory();
    		$category->asset_category_id = $data['category_id'];
    		$category->name = $data['sub_cat_name'];
    		$category->created_by = $user->id;
    		$category->is_active = 1;
    		$category->save();

    		return redirect('admin/view-assets-sub-categories')->with('flash_message_success','Assets Sub-Category successfully Added!');
    	}

    	$categories = DB::table('assets_categories')->get();
    	$category_dropdown = "<option disabled selected > Select Asset Category</option>";

    	foreach ($categories as $category) {
    		$category_dropdown .="<option value='".$category->id."'>".$category->name . "</option>";
    	}
    	return view('admin.assets.assetssubcategories.create-subcategories')->with(compact('category_dropdown'));
    }

    public function editAssetSubCategory(Request $request, $id =null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            AssetSubcategory::where(['id'=>$id])->update
            ([
                'asset_category_id' => $data['category_id'],
                'name' => $data['sub_cat_name'],
            ]);

            return redirect('/admin/view-assets-sub-categories')->with('flash_message_success','Assets Sub-Category has been Updated Successfully!');
        }
        $subcategories = AssetSubcategory::where(['id'=>$id])->first();
        $categories = DB::table('assets_categories')->get();

        $categories_dropdown = "<option value=''>Select Assets Category</option>";
         foreach($categories as $category){
            if($subcategories->asset_category_id == $category->id){
            $categories_dropdown .= "<option selected value='".$category->id."'>".$category->name . "</option>";
            }
            else{
            $categories_dropdown .= "<option value='".$category->id."'>".$category->name  . "</option>";
            }
         }
        return view('admin.assets.assetssubcategories.edit-subcategories')->with(compact('categories_dropdown','subcategories'));
    }

    public function deleteAssetSubCategory($id = null)
    {
        AssetSubcategory::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Assets Sub-Category has been deleted Successfully!');
    }

    // Assets Sub Category Functions Ends

    //Assets Products Functions Starts

    public function viewAssets()
    {
    	$assets = DB::table('assets as a')
    	->join('assets_categories as ac','a.asset_category_id','=','ac.id')
    	->join('assets_subcategories as asc','a.asset_subcategory_id','=','asc.id')
    	->join('assets_status as aa','a.status','=','aa.id')
    	->join('users as u','a.created_by','=','u.id')
    	->select('a.*','u.name as userName','ac.name as catName','asc.name as subcatName','aa.name as statuses')
    	->get();

    	return view('admin.assets.view-assets')->with(compact('assets'));
    }

    public function createAsset(Request $request){
    	$user = Auth::User();

    	if($request->isMethod('post')){
    		$data = $request->all();
            //dd($data);
    		$asset = new Asset();
    		$asset->asset_category_id = $data['asset_category_id'];
    		$asset->asset_subcategory_id = $data['assetsubcategory'];
            $asset->name = $data['asset_name'];
            $asset->document_no = $data['doc_no'];
            $asset->cost_amount = $data['amount'];
    		$asset->tax_amount = $data['tax'];
            $asset->total_amount = $data['total_amount'];
            $asset->status = 1;
            $asset->created_by = $user->id;
    		$asset->save();
            $asset_id = $asset->id;

            $asset_detail = new AssetVehicleDetail();
            $asset_detail->asset_id = $asset_id;
            $asset_detail->reg_no = $data['reg_no'];
            $asset_detail->engine_no = $data['engine_no'];
            $asset_detail->chasis_no = $data['chasis_no'];
            if($request->hasFile('vehicle_image')){

                $image_tmp = $request->vehicle_image;
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = 'vehicle'.rand(1111,9999999).'.'.$extension;
                        $large_image_path = 'images/backend-images/halalmeat/assets/vehicle/large/'.$filename;
                        $medium_image_path = 'images/backend-images/halalmeat/assets/vehicle/medium/'.$filename;
                        $small_image_path = 'images/backend-images/halalmeat/assets/vehicle/small/'.$filename;
                        $tiny_image_path = 'images/backend-images/halalmeat/assets/vehicle/tiny/'.$filename;
                        Image::make($image_tmp)->save($large_image_path);
                        Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(166,266)->save($small_image_path);
                        Image::make($image_tmp)->resize(100,100)->save($tiny_image_path);
                        $asset_detail->image = $filename;
                    }
                }
            $asset_detail->save();

    		return redirect('admin/view-vehicles')->with('flash_message_success','vehicle successfully Added!');
    	}

    	$categories = DB::table('assets_categories')->get();

        $categories_dropdown = "<option selected value=''>Select Assets Category</option>";
         foreach($categories as $category){
            
            $categories_dropdown .= "<option value='".$category->id."'>".$category->name . "</option>";
            }
            
         
    	return view('admin.assets.create-asset')->with(compact('categories_dropdown'));
    } 

    public function editAsset(Request $request, $id =null)
    {
        
        $user = Auth::user();
        $user_id = $user->id;

        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            
            Asset::where(['id'=>$id])->update
            ([
                'asset_subcategory_id' => $data['assetsubcategory'],
                'name' => $data['asset_name'],
                'document_no' => $data['doc_no'],
                'cost_amount' => $data['amount'],
                'tax_amount' => $data['tax'],
                'total_amount' => $data['total_amount'],
                'status' => $data['asset_status']
            
            ]);
            
            if($request->hasFile('vehicle_image')){

                $image_tmp = $request->vehicle_image;
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = 'vehicle'.rand(1111,9999999).'.'.$extension;
                        $large_image_path = 'images/backend-images/halalmeat/assets/vehicle/large/'.$filename;
                        $medium_image_path = 'images/backend-images/halalmeat/assets/vehicle/medium/'.$filename;
                        $small_image_path = 'images/backend-images/halalmeat/assets/vehicle/small/'.$filename;
                        $tiny_image_path = 'images/backend-images/halalmeat/assets/vehicle/tiny/'.$filename;
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

                AssetVehicleDetail::where(['asset_id'=>$id])->update
                ([
                    'reg_no' => $data['reg_no'],
                    'engine_no' => $data['engine_no'],
                    'chasis_no' => $data['chasis_no'],
                    'image' => $filename,
                    
            
                ]);

        return redirect('/admin/view-vehicles')->with('flash_message_success','vehicle has been Updated Successfully!'); 
        }
        $assets = DB::table('assets as a')
        ->join('assets_categories as ac','a.asset_category_id','=','ac.id')
        ->join('assets_subcategories as asc','a.asset_subcategory_id','=','asc.id')
        ->join('assets_status as aa','a.status','=','aa.id')
        ->join('assets_vehicle_details as avh','a.id','=','avh.asset_id')
        ->join('users as u','a.created_by','=','u.id')
        ->select('a.*','avh.*','u.name as userName','ac.name as catName','asc.name as subcatName','aa.name as statuses')
        ->first();

        $subcategories = DB::table('assets_subcategories')->get();
        $subcategories_dropdown = "<option value=''>Select SubCategory</option>";
         foreach($subcategories as $category){
            if($assets->asset_subcategory_id == $category->id){
            $subcategories_dropdown .= "<option selected value='".$category->id."'>".$category->name . "</option>";
            }
            else{
            $subcategories_dropdown .= "<option value='".$category->id."'>".$category->name  . "</option>";
            }
         }

        $statuses = DB::table('assets_status')->get();
        $status_dropdown = "<option value=''>Select Status</option>";
         foreach($statuses as $status){
            if($assets->status == $status->id){
            $status_dropdown .= "<option selected value='".$status->id."'>".$status->name . "</option>";
            }
            else{
            $status_dropdown .= "<option value='".$status->id."'>".$status->name  . "</option>";
            }
         }
        
        return view('admin.assets.edit-asset')->with(compact('assets','subcategories_dropdown','status_dropdown'));
    }

    public function deletevehicleimage($id)
    {
        AssetVehicleDetail::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('flash_message_success','Vehicle image has been Deleted Successfully!');
    }
}
