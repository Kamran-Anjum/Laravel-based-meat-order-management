<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function financelogin()
    {
        return view('departments.finance.finance-login');
    }
}
