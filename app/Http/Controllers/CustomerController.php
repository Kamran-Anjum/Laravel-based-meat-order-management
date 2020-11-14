<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\CustomerDetails;
use Auth;
use Image;
use Session;


class CustomerController extends Controller
{
    public function customerlogin()
    {
        return view('admin.customers.customers-login');
    }

    public function viewCustomers(){

    	$authorizedRoles = ['internal-customer', 'external-customer', 'private-customer','workforce','coop'];

		$users = User::whereHas('roles', static function ($query) use ($authorizedRoles) {
                    return $query->whereIn('name', $authorizedRoles);
                })->with('roles')->get();
		//dd($users);
    	return view('admin.customers.view-customers')->with(compact('users'));
    }

    public function commingsoon()
    {
    	return view('admin.working.working');
    }

    public function createCustomer(Request $request)
    {

        if($request->isMethod('post')){
            $data = $request->all();
             //dd($data);
            $usercount = User::where(['email'=>$data['customer_email']])->count();
            if($usercount>0)
            {               
                return redirect()->back()->with('flash_message_error', 'Email Already Exist');
            }
            else if($data['password'] != $data['cpassword']){
                return redirect()->back()->with('flash_message_error', 'Both Passwords are not Same');
            }
            else
            {
                $user = new User;
                $user->name = $data['customer_name'];
                $user->email = $data['customer_email'];
                $user->admin = 1;
                $user->is_active = $data['is_active'];
                $user->password = bcrypt($data['password']);
                $user->save();
                $user->assignRole($data['customer_role']);
                $userid = $user->id;

                $customer_detail = new CustomerDetails();
                $customer_detail->user_id = $userid;
                $customer_detail->address = $data['customer_address'];
                $customer_detail->cell_no = $data['customer_cell'];
                if($request->hasFile('customer_image')){

                $image_tmp = $request->customer_image;
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = 'customer'.rand(1111,9999999).'.'.$extension;
                        $large_image_path = 'images/backend-images/halalmeat/customer/large/'.$filename;
                        $medium_image_path = 'images/backend-images/halalmeat/customer/medium/'.$filename;
                        $small_image_path = 'images/backend-images/halalmeat/customer/small/'.$filename;
                        $tiny_image_path = 'images/backend-images/halalmeat/customer/tiny/'.$filename;
                        Image::make($image_tmp)->save($large_image_path);
                        Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(166,266)->save($small_image_path);
                        Image::make($image_tmp)->resize(100,100)->save($tiny_image_path);
                        $customer_detail->profile_image = $filename;
                    }
                }
                $customer_detail->save();

                return redirect('admin/view-customers')->with('flash_message_success','Customer registered successfully!');
            }
        }
        else
        {
            $roles = DB::table('roles')->whereNotIn('id',[1,2,3,4,10,11])->get();
            $roles_dropdown = "<option disabled selected > Select Role</option>";
            foreach ($roles as $role) {
                $roles_dropdown .= "<option value='".$role->name."'>".$role->name . "</option>";
            }
            //dd($roles);
            return view('admin.customers.create-customer')->with(compact('roles_dropdown'));
        }   
    }

    public function editCustomer(Request $request, $id = null){
        
        $user = Auth::user();
        $user_id = $user->id;

        if($request->isMethod('post')){
            $data = $request->all();
            
            if($request->hasFile('customer_image')){

                $image_tmp = $request->customer_image;
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = 'customer'.rand(1111,9999999).'.'.$extension;
                        $large_image_path = 'images/backend-images/halalmeat/customer/large/'.$filename;
                        $medium_image_path = 'images/backend-images/halalmeat/customer/medium/'.$filename;
                        $small_image_path = 'images/backend-images/halalmeat/customer/small/'.$filename;
                        $tiny_image_path = 'images/backend-images/halalmeat/customer/tiny/'.$filename;
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
            $usersu = User::where(['id'=>$id])->update
            ([
                'name' => $data['customer_name'],
                'email' => $data['customer_email'],
                'is_active' => $data['is_active']
            
            ]);
            $customer = User::find($id);
            /*$oldroles = Session::get('oldrole');*/
            $customer->syncRoles($data['customer_role']);
            /*$usersu->removeRole('internal customer');
            $usersu->assignRole($data['customer_role']);*/

            CustomerDetails::where(['user_id'=>$id])->update
            ([
                'address' => $data['customer_address'],
                'cell_no' => $data['customer_cell'],
                'profile_image' => $filename
            ]);
        return redirect('/admin/view-customers')->with('flash_message_success','Customer has been Updated Successfully!'); 
        }

        $authorizedRoles = ['internal customer', 'external customer', 'private customer','workforce'];

        $users = User::whereHas('roles', static function ($query) use ($authorizedRoles) {
                    return $query->whereIn('name', $authorizedRoles);
                })->where(['id'=>$id])->with('roles')->first();
        //dd($courseType);
        //$oldrole = ;
        //session::put('oldrole', $oldrole);
        //dd($oldrole);
        $customer_details = DB::table('customer_details')->where(['user_id'=>$id])->first();

        $roles = DB::table('roles')->whereNotIn('id',[1,2,3,4,10,11])->get();

        $roles_dropdown = "<option value=''>Select Role</option>";
         foreach($roles as $role){
            if($users->roles->first()->name == $role->name){
            $roles_dropdown .= "<option selected value='".$role->id."'>".$role->name . "</option>";
            }
            else{
            $roles_dropdown .= "<option value='".$role->id."'>".$role->name  . "</option>";
            }
         }
         //dd($roles_dropdown);
        return view('admin.customers.edit-customer')->with(compact('users','roles_dropdown','customer_details'));
    }

    public function deletecustomerimage($id)
    {
        CustomerDetails::where(['id'=>$id])->update(['profile_image'=>'']);
        return redirect()->back()->with('flash_message_success','Customer image has been Deleted Successfully!');
    }

}
