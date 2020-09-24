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

class SubCategoryController extends Controller
{
    public function viewSubCategories(){

    	$subcategories = DB::table('subcategories as sc')
    	->join('categories as c','sc.category_id','=', 'c.id')
    	->join('users as u','sc.created_by', '=', 'u.id')
    	->select('sc.*','c.name as catname','u.name as userName')
    	->get();

    	return view('admin.products.subcategories.view-subcategories')->with(compact('subcategories'));
    }

    public function createSubCategories(Request $request){
    	$user = Auth::User();

    	if($request->isMethod('post')){
    		$data = $request->all();

    		$category = new Subcategory();
    		$category->category_id = $data['category_id'];
    		$category->name = $data['sub_cat_name'];
    		$category->created_by = $user->id;
    		$category->save();

    		return redirect('admin/view-subcategories')->with('flash_message_success','Sub-Category successfully Added!');
    	}

    	$categories = DB::table('categories')->get();
    	$category_dropdown = "<option disabled selected > Select Category</option>";

    	foreach ($categories as $category) {
    		$category_dropdown .="<option value='".$category->id."'>".$category->name . "</option>";
    	}
    	return view('admin.products.subcategories.create-subcategories')->with(compact('category_dropdown'));
    }

    
}
