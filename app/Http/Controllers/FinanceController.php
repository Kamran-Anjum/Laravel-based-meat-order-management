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

class FinanceController extends Controller
{
    public function financelogin(Request $request)
    {
    	if($request->isMethod('post')){
    		$data = $request->input();
    		
    		if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                // Code: To set session
                /*
                Session::put('adminSession',$data['email']);
                */

    				return redirect('finance/dashboard');
    			}
    			else{
                    return redirect('/finance')->with('flash_message_error','Invalid Username or Password');
                }
    	}
        return view('departments.finance.finance-login');
    }

    public function dashboard(){
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
        return view('departments.finance.dashboard')->with(compact('today_sales','today_purchase'));
    }

    public function commingsoon()
    {
    	return view('admin.working.working');
    }
}
