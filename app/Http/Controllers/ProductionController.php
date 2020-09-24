<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductionController extends Controller
{
    public function productionlogin()
    {
        return view('departments.production.production-login');
    }
}
