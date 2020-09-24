<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\City;
use Auth;

class CityController extends Controller
{
    public function addCity(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $city = new City();
            $city->country_id = $data['countries_id'];
            $city->states_id = $data['states_id'];
            $city->name = $data['name'];
            $city->code = $data['code'];
            $city->short_name = $data['short_name'];
            $city->latitude = $data['latitude'];
            $city->longitude = $data['longitude'];
            $city->is_active = $data['is_active'];
            $city->created_by = $user_id;
            $city->save();
            return redirect('/admin/view-cities')->with('flash_message_success','City Added Successfully!');
        }
            $countries = DB::table('countries')->get();
    	    $countries_dropdown = "<option selected value='' disabled>Select</option>";
        	foreach($countries as $cont)
        	{
            	$countries_dropdown .= "<option value='".$cont->id."'>".$cont->name . "</option>";
        	}

        	$states = DB::table('states')->get();
    	    $states_dropdown = "<option selected value='' disabled>Select</option>";
        	foreach($states as $stat)
        	{
            	$states_dropdown .= "<option value='".$stat->id."'>".$stat->name . "</option>";
        	}	

        return view('admin.cities.create-cities')->with(compact('countries_dropdown', 'states_dropdown'));
    }

    public function viewCity()
    {
        $cities =DB::table('cities as ci')
        ->where('ci.is_active', '=', '1')
        ->join('users as u', 'ci.created_by', '=', 'u.id')
        ->join('countries as c', 'ci.country_id', '=', 'c.id')
		->join('states as s','ci.states_id','=','s.id')
        ->select('ci.*','c.name as country_name', 's.name as state_name', 'u.name as userName')
        ->get();
        return view('admin.cities.view-cities')->with(compact('cities'));
    }

    public function editCity(Request $request, $id =null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            City::where(['id'=>$id])->update
            ([
            	'country_id' => $data['countries_id'],
            	'states_id' => $data['states_id'],
            	'name' => $data['name'],
            	'code' => $data['code'],
             	'short_name' => $data['short_name'],
       			'latitude' => $data['latitude'],
            	'longitude' => $data['longitude'],
            	'is_active' => $data['is_active'],
            
            ]);

            return redirect('/admin/view-cities')->with('flash_message_success','City has been Updated Successfully!');
        }

        $cityDetails = City::where(['id'=>$id])->get();
        $countries = DB::table('countries')->get();
        $states = DB::table('states')->get();
        return view('admin.cities.edit-cities')->with(compact('cityDetails', 'countries', 'states'));
    }
    public function deleteCity($id = null)
    {
        City::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','City has been deleted Successfully!');
    }
}
