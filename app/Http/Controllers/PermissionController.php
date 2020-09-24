<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addPermission(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $role = new \Spatie\Permission\Models\Permission();
            $role->name = $data['name'];
            $role->guard_name = $data['guard_name'];
            $role->save();

            return redirect('/admin/view-permissions')->with('flash_message_success','Permission Added Successfully!');
        }

        return view('admin.user-management.permission.create-permissions');
    }

    public function viewPermission()
    {
        $permissions =DB::table('permissions')->get();
        return view('admin.user-management.permission.view-permissions')->with(compact('permissions'));
    }

    public function editPermission(Request $request, $id =null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
//            dd($data);
            \Spatie\Permission\Models\Permission::where(['id'=>$id])->update
            ([
                'name'=>$data['name'],
                'guard_name'=>$data['guard_name'],
            ]);
            return redirect('/admin/view-permissions')->with('flash_message_success','Permission has been Updated Successfully!');
        }

        $permissionDetails = \Spatie\Permission\Models\Permission::where(['id'=>$id])->first();
        $permissionDetails->save();
        return view('admin.user-management.permission.edit-permissions')->with(compact('permissionDetails'));
    }

    public function deletePermission($id = null)
    {
        Permission::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Permission has been deleted Successfully!');
    }
}
