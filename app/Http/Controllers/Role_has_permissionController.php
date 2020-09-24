<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Role_has_permissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addRolePermission(Request $request)
    {
        if($request->isMethod('post')){

            $data = $request->all();
//            $role = Role::findById('$data->role_id  ');
            $role = Role::findById($data['role_id']);
            $role->givePermissionTo($data['permission_id']);

            $role->save();

            /*return redirect()->back()->with('flash_message_success','Product Added Successfully!');*/
            return redirect('/admin/view-role-permission')->with('flash_message_success','Permission Assign Successfully!');

        }
        $roles = DB::table('roles')->get();
        $roles_dropdown = "<option selected value='' disabled>Select</option>";
        foreach($roles as $role){
            $roles_dropdown .= "<option value='".$role->id."'>".$role->name . "</option>";
        }
        $permissions = DB::table('permissions')->get();
        $permissions_dropdown = "<option selected value='' disabled>Select</option>";
        foreach($permissions as $permission){
            $permissions_dropdown .= "<option value='".$permission->id."'>".$permission->name . "</option>";
        }
//dd($permissions_dropdown);
        return view('admin.user-management.assign-permission.create-assign-permissions')->with(compact('roles_dropdown','permissions'));
    }

    public function viewRolePermission()
    {
        $roles =DB::table('role_has_permissions as rhp')
            ->join('roles as r','rhp.role_id','=','r.id')
            ->join('permissions as p','rhp.permission_id','=','p.id')
            ->select('r.name as r_name','p.name as p_name','p.id','rhp.role_id as r_id','rhp.permission_id as p_id')
            ->get();
//dd($roles);
//        $role = Role::findByName('vendor');
//        $permission = Permission::findById(1);
//        $muzi = $role->revokePermissionTo($permission);
        return view('admin.user-management.assign-permission.view-assign-permissions')->with(compact('roles'));
    }

    public function deleteRolePermission($id,$p_id){

        $role=DB::table('roles as r')->where('r.id','=',$id)->select('r.name')->first();
        $permission=DB::table('permissions as p')->where('p.id','=',$p_id)->select('p.name')->first();
        $roleid  = (int)$id;
        $role = Role::findById($roleid);
        $permissionid  = (int)$p_id;
        $permission = Permission::findById($permissionid);
        $muzi = $role->revokePermissionTo($permission);
//        $role->revokePermissioTo($permission);
        return redirect('/admin/view-role-permissions')->with('flash_message','Permission revoke!');

    }
}
