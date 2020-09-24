<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\State;
use Auth;

class StateController extends Controller
{
    public function addState(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;

        if($request->isMethod('post'))
        {
            $data = $request->all();
            $state = new State();
            $state->country_id = $data['countries_id'];
            $state->name = $data['name'];
            $state->code = $data['code'];
            $state->short_name = $data['short_name'];
            $state->latitude = $data['latitude'];
            $state->longitude = $data['longitude'];
            $state->is_active = $data['is_active'];
            $state->created_by = $user_id;
            $state->save();
            /*return redirect()->back()->with('flash_message_success','Product Added Successfully!');*/
            return redirect('/admin/view-states')->with('flash_message_success','State Added Successfully!');
        }
            $countries = DB::table('countries')->get();
    	    $countries_dropdown = "<option selected value='' disabled>Select</option>";
        	foreach($countries as $cont){
            $countries_dropdown .= "<option value='".$cont->id."'>".$cont->name . "</option>";
        }

        return view('admin.states.create-states')->with(compact('countries_dropdown'));
        
        // return view('admin.states.create-states');
    }

    public function viewState()
    {
        $states =DB::table('states as s')
        ->where('s.is_active', '=', '1')
        ->join('users as u', 's.created_by', '=', 'u.id')        
        ->join('countries as c', 's.country_id', '=', 'c.id')
        ->select('s.*','c.name as country_name', 'u.name as userName')
        ->get();
        return view('admin.states.view-states')->with(compact('states'));
    }

    public function editState(Request $request, $id =null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            State::where(['id'=>$id])->update
            ([
            	'country_id' => $data['countries_id'],
            	'name' => $data['name'],
            	'code' => $data['code'],
             	'short_name' => $data['short_name'],
       			'latitude' => $data['latitude'],
            	'longitude' => $data['longitude'],
            	'is_active' => $data['is_active'],
            
            ]);

            return redirect('/admin/view-states')->with('flash_message_success','State has been Updated Successfully!');
        }

        $stateDetails = State::where(['id'=>$id])->get();
        $countries = DB::table('countries')->get();
        // echo $countryDetails; die;
        // $countryDetails->save();
        return view('admin.states.edit-states')->with(compact('stateDetails', 'countries'));
    }
    public function deleteState($id = null)
    {
        State::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','State has been deleted Successfully!');
    }
}
