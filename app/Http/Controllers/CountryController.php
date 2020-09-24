<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\Country;
use Auth;

class CountryController extends Controller
{
    public function addCountry(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $country = new Country();
            $country->name = $data['name'];
            $country->code = $data['code'];
            $country->short_name = $data['short_name'];
            $country->latitude = $data['latitude'];
            $country->longitude = $data['longitude'];
            $country->created_by = $user_id;
            $country->is_active = $data['is_active'];
            $country->save();
            /*return redirect()->back()->with('flash_message_success','Product Added Successfully!');*/
            return redirect('/admin/view-countries')->with('flash_message_success','Country Added Successfully!');
        }
        
        return view('admin.countries.create-countries');
    }

    public function viewCountry()
    {
        $countries =DB::table('countries as c')
        ->where('is_active','=','1')
        ->join('users as u', 'c.created_by', '=', 'u.id')
        ->select('c.*', 'u.name as userName')
        ->get();

        return view('admin.countries.view-countries')->with(compact('countries'));
    }

    public function editCountry(Request $request, $id =null)
    {

        if($request->isMethod('post')){
            $data = $request->all();
            Country::where(['id'=>$id])->update
            ([
            	'name' => $data['name'],
            	'code' => $data['code'],
             	'short_name' => $data['short_name'],
       			'latitude' => $data['latitude'],
            	'longitude' => $data['longitude'],
            	'is_active' => $data['is_active'],
            
            ]);

            return redirect('/admin/view-countries')->with('flash_message_success','Country has been Updated Successfully!');
        }

        $countryDetails = Country::where(['id'=>$id])->get();
        // echo $countryDetails; die;
        // $countryDetails->save();
        return view('admin.countries.edit-countries')->with(compact('countryDetails'));
    }
    public function deleteCountry($id = null)
    {
        Country::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Country has been deleted Successfully!');
    }
}
