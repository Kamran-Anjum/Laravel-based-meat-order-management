<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addRole(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $role = new \Spatie\Permission\Models\Role();
            $role->name = $data['name'];
            $role->guard_name = $data['guard_name'];

            $role->save();
            /*return redirect()->back()->with('flash_message_success','Product Added Successfully!');*/
            return redirect('/admin/view-roles')->with('flash_message_success','Role Added Successfully!');
        }
        return view('admin.user-management.role.create-roles');
    }

    public function viewRole()
    {
        $roles =DB::table('roles')->get();
        return view('admin.user-management.role.view-roles')->with(compact('roles'));
    }

    public function editRole(Request $request, $id =null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
//            dd($data);
            \Spatie\Permission\Models\Role::where(['id'=>$id])->update
            ([
                'name'=>$data['name'],
                'guard_name'=>$data['guard_name'],
            ]);

            return redirect('admin/view-roles')->with('flash_message_success','Role has been Updated Successfully!');
        }

        $roleDetails = \Spatie\Permission\Models\Role::where(['id'=>$id])->first();
        $roleDetails->save();
        return view('admin.user-management.role.edit-roles')->with(compact('roleDetails'));
    }

    public function deleteRole($id = null)
    {
//        dd('here');
        Role::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Role has been deleted Successfully!');
    }
}
