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
        $orders = DB::table('orders')->whereDate('created_at',date('Y-m-d'))->get();
        $today_sales = 0;
        foreach ($orders as $value) {
            $today_sales = $today_sales+$value->total_amount;
        }
        $porders = DB::table('purchase_order')->whereDate('created_at',date('Y-m-d'))->get();
        $today_purchase = 0;
        foreach ($porders as $pvalue) {
            $today_purchase = $today_purchase+$pvalue->total_amount;
        }
                //dd($total_amount);
        return view('admin.dashboard')->with(compact('today_sales','today_purchase'));
    }

    public function addadmin(){

        $user = new User();
                $user->name = "Finance Admin";
                $user->email = "finance@halalmeat.com";
                $user->password = bcrypt("finance123");
                $user->admin = 1;
                $user->is_active = 1;
                $user->save();
                $user->assignRole('finance-admin');

                return redirect('/logout');
    }

    public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_success','Logged out Successfully');
    }

}