<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use Auth;


class CustomerController extends Controller
{
    public function customerlogin()
    {
        return view('customers.customers-login');
    }

    public function viewCustomers(){

    	$authorizedRoles = ['internal customer', 'external customer', 'private customer','workforce','super-admin'];

		$users = User::whereHas('roles', static function ($query) use ($authorizedRoles) {
                    return $query->whereIn('name', $authorizedRoles);
                })->with('roles')->get();
		//dd($users);
    	return view('admin.customers.view-customers')->with(compact('users'));
    }

    public function commingsoon()
    {
    	return view('admin.working.working');
    }
}
