<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductStock;
use App\Models\User;
use PDF;

class ProductionOrderSummaryController extends Controller
{
    public function viewOrdersSummary(){

    	$orders = DB::table('orders as o')
    	//->whereIn('o.status',[5,6])
    	->join('purchase_order_status as ps','o.status','=','ps.id')
    	->join('users as u','o.user_id', '=', 'u.id')
    	->select('o.*','u.name as customerName','ps.name as s_status')
    	->get();

    	$roles = DB::table('roles')->whereNotIn('id',[1,2,3,4])->get();
            $roles_dropdown = "<option value='0' readonly selected > Select Role</option>";
            foreach ($roles as $role) {
                $roles_dropdown .= "<option value='".$role->id."'>".$role->name . "</option>";
            }
    	//dd($orders);
    	return view('departments.production.ordersummary.list-orders')->with(compact('orders','roles_dropdown'));
    }

    public function SortReport($fromdate, $todate, $role, $user)
    {
    	if ($role == 0 && $user == 0) {
    		if ($fromdate == $todate) {
            	$sortorders = DB::table('orders as o')->whereDate('o.created_at',$fromdate)
                ->whereIn('o.status',[5])
            	->join('users as u','o.user_id', '=', 'u.id')
    			->join('purchase_order_status as ps','o.status','=','ps.id')
    			->select('o.*','u.name as customerName','ps.name as s_status')
    			->get();
            }
        	else{
            	$sortorders = DB::table('orders as o')->whereBetween('o.created_at', [$fromdate, $todate])
                ->whereIn('o.status',[5])
            	->join('users as u','o.user_id', '=', 'u.id')
    			->join('purchase_order_status as ps','o.status','=','ps.id')
    			->select('o.*','u.name as customerName','ps.name as s_status')
    			->get();
            
        	}
    	}
    	elseif ($user == 0) {
    		//$sortorders = [];
    		$users = User::whereHas('roles', static function ($query) use ($role) {
                    return $query->where('id', $role);
                })->with('roles')->get();

    		foreach ($users as $roless) {
    			$sortorders = DB::table('orders as o')->whereBetween('o.created_at', [$fromdate, $todate])
    			->where(['o.user_id'=> $roless->id])
                ->whereIn('o.status',[5])
    			->join('users as u','o.user_id', '=', 'u.id')
    			->join('purchase_order_status as ps','o.status','=','ps.id')
    			->select('o.*','u.name as customerName','ps.name as s_status')
    			->get();
    		}
    		
    	}
    	else{
    		$sortorders = DB::table('orders as o')->whereBetween('o.created_at', [$fromdate, $todate])
    		->where(['o.user_id'=> $user])
            ->whereIn('o.status',[5])
    		->join('users as u','o.user_id', '=', 'u.id')
    		->join('purchase_order_status as ps','o.status','=','ps.id')
    		->select('o.*','u.name as customerName','ps.name as s_status')
    		->get();
    	}
    	
    	return $sortorders;
    }

    public function pdfreport($fromdate, $todate, $role, $user)
    {
        if ($role == 0 && $user == 0) {
    		if ($fromdate == $todate) {
            	$sortorders = DB::table('orders as o')->whereDate('o.created_at',$fromdate)
                ->whereIn('o.status',[5])
            	->join('users as u','o.user_id', '=', 'u.id')
    			->join('purchase_order_status as ps','o.status','=','ps.id')
    			->select('o.*','u.name as customerName','ps.name as s_status')
    			->get();
            }
        	else{
            	$sortorders = DB::table('orders as o')->whereBetween('o.created_at', [$fromdate, $todate])
                ->whereIn('o.status',[5])
            	->join('users as u','o.user_id', '=', 'u.id')
    			->join('purchase_order_status as ps','o.status','=','ps.id')
    			->select('o.*','u.name as customerName','ps.name as s_status')
    			->get();
            
        	}
    	}
    	elseif ($user == 0) {
    		//$sortorders = [];
    		$users = User::whereHas('roles', static function ($query) use ($role) {
                    return $query->where('id', $role);
                })->with('roles')->get();

    		foreach ($users as $roless) {
    			$sortorders = DB::table('orders as o')->whereBetween('o.created_at', [$fromdate, $todate])
    			->where(['o.user_id'=> $roless->id])
                ->whereIn('o.status',[5])
    			->join('users as u','o.user_id', '=', 'u.id')
    			->join('purchase_order_status as ps','o.status','=','ps.id')
    			->select('o.*','u.name as customerName','ps.name as s_status')
    			->get();
    		}
    		
    	}
    	else{
    		$sortorders = DB::table('orders as o')->whereBetween('o.created_at', [$fromdate, $todate])
    		->where(['o.user_id'=> $user])
            ->whereIn('o.status',[5])
    		->join('users as u','o.user_id', '=', 'u.id')
    		->join('purchase_order_status as ps','o.status','=','ps.id')
    		->select('o.*','u.name as customerName','ps.name as s_status')
    		->get();
    	}
    	
    	//return view('admin.reports.sales-report', compact('sortorders'));
      // share data to view
    	
      view()->share('sortorders',$sortorders);
      $pdf = PDF::loadView('admin.reports.sales-report', $sortorders);
      //$pdf->stream('invoice_po_'.$fromdate.'.pdf');

      // download PDF file with download method
      return $pdf->stream('invoice_po_'.$fromdate.'.pdf');
    }

    public function excelview($fromdate, $todate, $role, $user)
    {
        if ($role == 0 && $user == 0) {
    		if ($fromdate == $todate) {
            	$sortorders = DB::table('orders as o')->whereDate('o.created_at',$fromdate)
                ->whereIn('o.status',[5])
            	->join('users as u','o.user_id', '=', 'u.id')
    			->join('purchase_order_status as ps','o.status','=','ps.id')
    			->select('o.*','u.name as customerName','ps.name as s_status')
    			->get();
            }
        	else{
            	$sortorders = DB::table('orders as o')->whereBetween('o.created_at', [$fromdate, $todate])
                ->whereIn('o.status',[5])
            	->join('users as u','o.user_id', '=', 'u.id')
    			->join('purchase_order_status as ps','o.status','=','ps.id')
    			->select('o.*','u.name as customerName','ps.name as s_status')
    			->get();
            
        	}
    	}
    	elseif ($user == 0) {
    		//$sortorders = [];
    		$users = User::whereHas('roles', static function ($query) use ($role) {
                    return $query->where('id', $role);
                })->with('roles')->get();

    		foreach ($users as $roless) {
    			$sortorders = DB::table('orders as o')->whereBetween('o.created_at', [$fromdate, $todate])
    			->where(['o.user_id'=> $roless->id])
                ->whereIn('o.status',[5])
    			->join('users as u','o.user_id', '=', 'u.id')
    			->join('purchase_order_status as ps','o.status','=','ps.id')
    			->select('o.*','u.name as customerName','ps.name as s_status')
    			->get();
    		}
    		
    	}
    	else{
    		$sortorders = DB::table('orders as o')->whereBetween('o.created_at', [$fromdate, $todate])
    		->where(['o.user_id'=> $user])
            ->whereIn('o.status',[5])
    		->join('users as u','o.user_id', '=', 'u.id')
    		->join('purchase_order_status as ps','o.status','=','ps.id')
    		->select('o.*','u.name as customerName','ps.name as s_status')
    		->get();
    	}

        return view('admin.reports.sales-report-excel', compact('sortorders'));
    }

    public function export($fromdate, $todate, $role, $user) 
    {
        return Excel::download(new ExcelExport($fromdate, $todate, $role, $user), 'salereport'.$fromdate.'.xlsx');
    }
}
