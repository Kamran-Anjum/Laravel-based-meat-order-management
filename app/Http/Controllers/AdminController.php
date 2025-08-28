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
                    $users = Auth::User();

                    $user = User::where(['id'=> $users->id])->with('roles')->first();

                    $role_name = $user->roles->first()->name;
                    //dd($role_name);
                    if($role_name == "super-admin"){
                        return redirect('admin/dashboard');
                    }
    				elseif ($role_name == "production-admin") {
                        return redirect('production/dashboard');
                    }
                    elseif ($role_name == "packing-admin") {
                        return redirect('packing/dashboard');
                    }
                    elseif ($role_name == "transport-admin") {
                        return redirect('transport/dashboard');
                    }
                    elseif ($role_name == "finance-admin") {
                        return redirect('finance/dashboard');
                    }
                    else{
                        Session::flush();
                        return redirect('/admin')->with('flash_message_error','You do not have Rights to Access');
                    }
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
                $user->name = "Resturant";
                $user->email = "resturant@halalmeat.com";
                $user->password = bcrypt("resturant123");
                $user->admin = 1;
                $user->is_active = 1;
                $user->is_assign = 0;
                $user->save();
                $user->assignRole('external-customer');

                return redirect('/logout');
    }

    public function changepassword(Request $request){

        if($request->isMethod('post')){

            $data = $request->all();

            $check_password = User::where(['email' => Auth::user()->email])->first();
            $current_password = $data['currentPassword'];

            if(Hash::check($current_password,$check_password->password)){
                $password = bcrypt($data['newPassword']);
                // echo $password;
                // die;
                User::where('email',Auth::user()->email)->update(['password' => $password]);
                return redirect()->back()->with('flash_message_success','Password updated successfully');
            }else{
                return redirect()->back()->with('flash_message_error','Incorrect current password ');
            }

            //echo '<pre>'.print_r($data); die;
        }else{
            return view('admin.change-password');
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_success','Logged out Successfully');
    }

    public function viewExpences()
    {
        $expences = DB::table('expences as e')
        ->join('expence_type as et', 'e.type','=','et.id')
        ->join('users as u','e.created_by','=','u.id')
        ->select('e.*','et.name as typeName','u.name as userName')
        ->get();
        return view('admin.expence.view-expences')->with(compact('expences'));
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

            return redirect('admin/view-expences')->with('flash_message_success','Expence successfully Added!');
        }

        $expence_type = DB::table('expence_type')->get();
        $expence_dropdown = "<option disabled selected > Select Type</option>";

        foreach ($expence_type as $exp) {
            $expence_dropdown .="<option value='".$exp->id."'>".$exp->name . "</option>";
        }
        return view('admin.expence.create-expence')->with(compact('expence_dropdown'));
    }

    public function editExpence(Request $request, $id =null)
    {
        
        $user = Auth::user();
        $user_id = $user->id;

        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            if($request->hasFile('image')){

                $image_tmp = $request->image;
                    if($image_tmp->isValid()){
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = 'product'.rand(1111,9999999).'.'.$extension;
                        $large_image_path = 'images/backend-images/halalmeat/expence/large/'.$filename;
                        $medium_image_path = 'images/backend-images/halalmeat/expence/medium/'.$filename;
                        $small_image_path = 'images/backend-images/halalmeat/expence/small/'.$filename;
                        $tiny_image_path = 'images/backend-images/halalmeat/expence/tiny/'.$filename;
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
            Expence::where(['id'=>$id])->update
            ([
                'name' => $data['e_name'],
                'type' => $data['e_type'],
                'amount' => $data['e_price'],
                'image' => $filename
            
            ]);


        return redirect('/admin/view-expences')->with('flash_message_success','Expence has been Updated Successfully!'); 
        }
        $expences = DB::table('expences')
        ->where(['id'=>$id])
        ->first();

        $expence_type = DB::table('expence_type')->get();

        $expence_dropdown = "<option value=''>Select Type</option>";
        foreach($expence_type as $type){
            if($type->id == $expences->type){
            $expence_dropdown .= "<option selected value='".$type->id."'>".$type->name . "</option>";
            }
            else{
            $expence_dropdown .= "<option value='".$type->id."'>".$type->name  . "</option>";
            }
         }

        return view('admin.expence.edit-expence')->with(compact('expences','expence_dropdown'));
    }

    public function deleteexpenceimage($id)
    {
        Expence::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('flash_message_success','Expence image has been Deleted Successfully!');
    }

}