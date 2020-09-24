<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\State;
use App\Models\City;


class AjaxRequestController extends Controller
{
	//Get Subcategories
    public function getsubcategoriesdropdown($id = null){

        $subcategories = DB::table('subcategories')
                ->whereIn('category_id',array($id))->get();

                $subcategories_dropdown = "";
                foreach($subcategories as $subcategory){
                    $subcategories_dropdown .= "<option value='".$subcategory->id."'>".$subcategory->name . "</option>";      
                     }
        
        
        return $subcategories_dropdown;

    }

    public function getStateName($id)
	{
		$states = State::where(['country_id'=>$id, 'is_active'=>1])->get();
		return $states;
	}

	public function getCityName($cid, $id)
	{
		$cities = City::where(['country_id'=>$cid, 'states_id'=>$id, 'is_active'=>1])->get();
		return $cities;
	}

	public function getSupplierDetail($id = null){

        $suppliers = DB::table('suppliers as sc')
            ->where(['sc.id' => $id])
            ->join('countries as c','sc.country_id','=','c.id')
            ->join('states as s','sc.country_id','=','s.id')
            ->join('cities as ct','sc.country_id','=','ct.id')
            ->join('users as u','sc.created_by','=','u.id')
            ->select('sc.*','u.name as userName','c.name as country','s.name as statename','ct.name as cityname')
            // ->groupBy('sc.batch_id')
            ->first();
            $supp_detail = "<tr class='gradeX'><td><strong>Supplier Name:  </strong>".$suppliers->supplier_name."</td></tr><tr class='gradeX'><td><strong>Supplier Contact No:  </strong>".$suppliers->contact_no."</td></tr><tr class='gradeX'><td><strong>Supplier Email:  </strong>".$suppliers->email."</td></tr><tr class='gradeX'><td><strong>Supplier Address:  </strong>".$suppliers->address."</td></tr><tr class='gradeX'><td><strong>Supplier City:  </strong>".$suppliers->cityname."</td></tr><tr class='gradeX'><td><strong>Supplier State:  </strong>".$suppliers->statename."</td></tr><tr class='gradeX'><td><strong>Supplier Country:  </strong>".$suppliers->country."</td></tr><tr class='gradeX'><td><strong>Supplier Created By:  </strong>".$suppliers->userName."</td></tr><tr class='gradeX'><td><strong>Status:  </strong>Active</td></tr><tr class='gradeX'><td><strong>Supplier Image:  </strong><img src='http://127.0.0.1:8000/images/backend-images/halalmeat/supplier/tiny/".$suppliers->image."'</td></tr><tr class='gradeX'><td><strong>Created At:  </strong>".$suppliers->created_at."</td></tr>";
        return $supp_detail;

    }
}
