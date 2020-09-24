<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Session;
use App\Models\User;

class AdminController extends Controller
{
    use  Notifiable, HasRoles;
	public function adminlogin(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->input();
    		
    		if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                // Code: To set session
                /*
                Session::put('adminSession',$data['email']);
                */
    				return redirect('admin/dashboard');
    			}
    			else{
                    return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
                }
    	}
    	return view('admin.admin-login');
    
	}
public function dashboard(){
        // Code: For session authentication
        /*
        if(Session::has('adminSession')){

        }else{
            return redirect('/admin')->with('flash_message_error','Please login to access');
        }
        */
       /* $user = Auth::User();
        $user->assignRole('super-admin');*/
        return view('admin.dashboard');
    }

    public function addadmin(){

        $user = new User();
                $user->name = "admin";
                $user->email = "supplier@halalmeat.com";
                $user->password = bcrypt("supplier123");
                $user->admin = 1;
                $user->save();
                $user->assignRole('supplier');

                return redirect('/logout');
    }

}