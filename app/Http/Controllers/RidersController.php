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

class RidersController extends Controller
{
    public function viewRiders(){

    	$authorizedRoles = ['Rider'];

		$users = User::whereHas('roles', static function ($query) use ($authorizedRoles) {
                    return $query->whereIn('name', $authorizedRoles);
                })->with('roles')->get();
		//dd($users);
    	return view('admin.riders.view-riders')->with(compact('users'));
    }

    public function createRider(Request $request)
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

                return redirect('admin/view-riders')->with('flash_message_success','Rider registered successfully!');
            }
        }
        else
        {
            $roles = DB::table('roles')->where(['id'=> 10])->get();
            $roles_dropdown = "<option disabled selected > Select Role</option>";
            foreach ($roles as $role) {
                $roles_dropdown .= "<option value='".$role->name."'>".$role->name . "</option>";
            }
            //dd($roles);
            return view('admin.riders.create-rider')->with(compact('roles_dropdown'));
        }   
    }

    public function editRider(Request $request, $id = null){
        
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

            CustomerDetails::where(['user_id'=>$id])->update
            ([
                'address' => $data['customer_address'],
                'cell_no' => $data['customer_cell'],
                'profile_image' => $filename
            ]);
        return redirect('/admin/view-riders')->with('flash_message_success','Rider has been Updated Successfully!'); 
        }

        $authorizedRoles = ['Rider'];

        $users = User::whereHas('roles', static function ($query) use ($authorizedRoles) {
                    return $query->whereIn('name', $authorizedRoles);
                })->where(['id'=>$id])->with('roles')->first();
        //dd($courseType);
        //$oldrole = ;
        //session::put('oldrole', $oldrole);
        //dd($oldrole);
        $customer_details = DB::table('customer_details')->where(['user_id'=>$id])->first();

        
         //dd($roles_dropdown);
        return view('admin.riders.edit-rider')->with(compact('users','customer_details'));
    }
}
