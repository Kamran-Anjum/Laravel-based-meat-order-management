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

    public function editCategory(Request $request, $id =null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            Category::where(['id'=>$id])->update
            ([
                'name' => $data['cat_name'],
            ]);

            return redirect('/admin/view-categories')->with('flash_message_success','Category has been Updated Successfully!');
        }

        $categories = Category::where(['id'=>$id])->first();
        return view('admin.products.categories.edit-categories')->with(compact('categories'));
    }

    public function deleteCategory($id = null)
    {
        Category::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Category has been deleted Successfully!');
    }
}
