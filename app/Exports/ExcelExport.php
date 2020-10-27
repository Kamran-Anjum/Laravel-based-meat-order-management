<?php

namespace App\Exports;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class ExcelExport implements FromCollection,WithHeadings
{
	protected $fromdate;
	protected $todate;
	protected $role;
	protected $user;

 function __construct($fromdate,$todate,$role,$user) {
        $this->fromdate = $fromdate;
        $this->todate = $todate;
        $this->role = $role;
        $this->user = $user;
 }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$rolee = $this->role;
        if ($this->role == 0 && $this->user == 0) {
    		if ($this->fromdate == $this->todate) {
            	$sortorders = DB::table('orders as o')->whereDate('o.created_at',$this->fromdate)
            	->join('users as u','o.user_id', '=', 'u.id')
    			->join('purchase_order_status as ps','o.status','=','ps.id')
    			->select('o.id','o.created_at','o.discount','o.total_amount','u.name as customerName','ps.name as s_status')
    			->get();
            }
        	else{
            	$sortorders = DB::table('orders as o')->whereBetween('o.created_at', [$this->fromdate, $this->todate])
            	->join('users as u','o.user_id', '=', 'u.id')
    			->join('purchase_order_status as ps','o.status','=','ps.id')
    			->select('o.id','o.created_at','o.discount','o.total_amount','u.name as customerName','ps.name as s_status')
    			->get();
            
        	}
    	}
    	elseif ($this->user == 0) {
    		//$sortorders = [];
    		$users = User::whereHas('roles', static function ($query) use ($rolee) {
                    return $query->where('id', $rolee);
                })->with('roles')->get();

    		foreach ($users as $roless) {
    			$sortorders = DB::table('orders as o')->whereBetween('o.created_at', [$this->fromdate, $this->todate])
    			->where(['o.user_id'=> $roless->id])
    			->join('users as u','o.user_id', '=', 'u.id')
    			->join('purchase_order_status as ps','o.status','=','ps.id')
    			->select('o.id','o.created_at','o.discount','o.total_amount','u.name as customerName','ps.name as s_status')
    			->get();
    		}
    		
    	}
    	else{
    		$sortorders = DB::table('orders as o')->whereBetween(['o.created_at', $this->$fromdate, $this->todate])
    		->where(['o.user_id'=> $this->user])
    		->join('users as u','o.user_id', '=', 'u.id')
    		->join('purchase_order_status as ps','o.status','=','ps.id')
    		->select('o.id','o.created_at','o.discount','u.name as customerName','ps.name as s_status')
    		->get();
    	}

    	return $sortorders;
    }

    public function headings(): array
    {
        return [
            'order no',
            'order date',
            'order quantity',
            'order total amount',
            'customer name',
            'status',
        ];
    }
}
