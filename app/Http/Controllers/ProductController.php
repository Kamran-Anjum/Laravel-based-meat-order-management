<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSubcategory;
use App\Models\ProductDetail;
use Image;

class ProductController extends Controller
{
    public function viewProducts(){

    	$products = DB::table('products as p')
        ->join('categories as c','p.category_id','=','c.id')
    	->join('users as u','p.created_by', '=', 'u.id')
    	->select('p.*','u.name as userName','c.name as catname')
    	->get();

    	return view('admin.products.view-products')->with(compact('products'));
    }

    public function createProduct(Request $request){
    	$user = Auth::User();

    	if($request->isMethod('post')){
    		$data = $request->all();
            //dd($data);
    		$product = new Product();
    		$product->category_id = $data['product_category_id'];
    		$product->sku_number = $data['sku_number'];
            $product->name = $data['product_name'];
            $product->base_price     = $data['base_price'];
            $product->description = $data['description'];
    		$product->created_by = $user->id;
            if($request->hasFile('image')){

                $image_tmp = $request->image;
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = 'product'.rand(1111,9999999).'.'.$extension;
                        $large_image_path = 'images/backend-images/halalmeat/products/large/'.$filename;
                        $medium_image_path = 'images/backend-images/halalmeat/products/medium/'.$filename;
                        $small_image_path = 'images/backend-images/halalmeat/products/small/'.$filename;
                        $tiny_image_path = 'images/backend-images/halalmeat/products/tiny/'.$filename;
                        Image::make($image_tmp)->save($large_image_path);
                        Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(166,266)->save($small_image_path);
                        Image::make($image_tmp)->resize(100,100)->save($tiny_image_path);
                        $product->image = $filename;
                    }
                }
    		$product->save();
            $product_id = $product->id;

                for ($i=0; $i <count($data['subcategory']) ; $i++) { 
                    
                    $subcategory = new ProductSubcategory();
                    $subcategory->product_id = $product_id;
                    $subcategory->subcategory_id = $data['subcategory'][$i];
                    $subcategory->save();
                }

                if($request->hasFile('gallery_images')){
                    $files=$request->gallery_images;
                    foreach($files as $file){
                        $productdetail = new ProductDetail();
    //                    $image_tmp = Input::file('image');
                        if($file->isValid()){
                            $image_tmp=$file;
                            $extensions = $image_tmp->getClientOriginalExtension();
                            $filenames = 'product_gallery'.rand(1111,9999999).'.'.$extensions;
                            $large_image_path = 'images/backend-images/halalmeat/gallery-products/large/'.$filenames;
                            $medium_image_path = 'images/backend-images/halalmeat/gallery-products/medium/'.$filenames;
                            $small_image_path = 'images/backend-images/halalmeat/gallery-products/small/'.$filenames;
                            $tiny_image_path = 'images/backend-images/halalmeat/gallery-products/tiny/'.$filenames;
                            Image::make($image_tmp)->save($large_image_path);
                            Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                            Image::make($image_tmp)->resize(166,266)->save($small_image_path);
                            Image::make($image_tmp)->resize(100,100)->save($tiny_image_path);
                            $productdetail->gallery_image = $filenames;
    //
                        }
                        $productdetail->product_id= $product_id;
                        $productdetail->save();
                    }
    //                dd($filenames);
                }

    		return redirect('admin/view-products')->with('flash_message_success','Product successfully Added!');
    	}

    	$categories = DB::table('categories')->get();
    	$category_dropdown = "<option disabled selected > Select Category</option>";

    	foreach ($categories as $category) {
    		$category_dropdown .="<option value='".$category->id."'>".$category->name . "</option>";
    	}
    	return view('admin.products.create-product')->with(compact('category_dropdown'));
    }
}
