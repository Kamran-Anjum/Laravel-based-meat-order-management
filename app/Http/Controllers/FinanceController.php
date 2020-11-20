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
use App\Models\Expence;
use Image;

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
        $orders = DB::table('orders')->where(['delivery_status'=> [15]])->get();
        //dd($orders);
        $today_sales = 0;
        foreach ($orders as $value) {
            $today_sales = $today_sales+$value->total_amount;
        }
        $porders = DB::table('purchase_order')->where(['status' => 2])->get();
        $today_purchase = 0;
        foreach ($porders as $pvalue) {
            $today_purchase = $today_purchase+$pvalue->total_amount;
        }
        $expences = DB::table('expences')->get();
        $today_expence = 0;
        foreach ($expences as $expence) {
            $today_expence = $today_expence+$expence->amount;
        }
                //dd($total_amount);
        return view('departments.finance.dashboard')->with(compact('today_sales','today_purchase','today_expence'));
    }

    public function commingsoon()
    {
    	return view('admin.working.working');
    }

    public function viewOrders(){

        $orders = DB::table('orders as o')
        ->where(['delivery_status'=> 15])
        ->join('po_priority_status as pos','o.priority_status','=','pos.id')
        ->join('purchase_order_status as ps','o.status','=','ps.id')
        ->join('order_location_status as ols','o.location_status','=','ols.id')
        ->join('users as u','o.created_by', '=', 'u.id')
        ->select('o.*','u.name as order_by','pos.name as pr_status','ps.name as s_status','ols.name as loc_status')
        ->get();
        //dd($orders);
        return view('departments.finance.orders.list-orders')->with(compact('orders'));
    }

    public function viewExpences()
    {
        $expences = DB::table('expences as e')
        ->join('expence_type as et', 'e.type','=','et.id')
        ->join('users as u','e.created_by','=','u.id')
        ->select('e.*','et.name as typeName','u.name as userName')
        ->get();
        return view('departments.finance.expence.view-expences')->with(compact('expences'));
    }

    public function addExpence(Request $request){
        $user = Auth::User();

        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $expence = new Expence();
            $expence->name = $data['e_name'];
            $expence->type = $data['e_type'];
            $expence->amount = $data['e_price'];
            $expence->created_by = $user->id;
            if($request->hasFile('image')){

                $image_tmp = $request->image;
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = 'expence'.rand(1111,9999999).'.'.$extension;
                        $large_image_path = 'images/backend-images/halalmeat/expence/large/'.$filename;
                        $medium_image_path = 'images/backend-images/halalmeat/expence/medium/'.$filename;
                        $small_image_path = 'images/backend-images/halalmeat/expence/small/'.$filename;
                        $tiny_image_path = 'images/backend-images/halalmeat/expence/tiny/'.$filename;
                        Image::make($image_tmp)->save($large_image_path);
                        Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                        Image::make($image_tmp)->resize(166,266)->save($small_image_path);
                        Image::make($image_tmp)->resize(100,100)->save($tiny_image_path);
                        $expence->image = $filename;
                    }
                }
            $expence->save();

            return redirect('finance/view-expence')->with('flash_message_success','Expence successfully Added!');
        }

        $expence_type = DB::table('expence_type')->get();
        $expence_dropdown = "<option disabled selected > Select Type</option>";

        foreach ($expence_type as $exp) {
            $expence_dropdown .="<option value='".$exp->id."'>".$exp->name . "</option>";
        }
        return view('departments.finance.expence.create-expence')->with(compact('expence_dropdown'));
    }
}
