<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Category;

class CategoryController extends Controller
{
    public function viewCategories(){

    	$categories = DB::table('categories as c')
    	->join('users as u','c.created_by', '=', 'u.id')
    	->select('c.*','u.name as userName')
    	->get();

    	return view('admin.products.categories.view-categories')->with(compact('categories'));
    }

    public function createCategories(Request $request){
    	$user = Auth::User();

    	if($request->isMethod('post')){
    		$data = $request->all();

    		$category = new Category();
    		$category->name = $data['cat_name'];
    		$category->created_by = $user->id;
    		$category->save();

    		return redirect('admin/view-categories')->with('flash_message_success','Category successfully Added!');
    	}


    	return view('admin.products.categories.create-categories');
    }
}
