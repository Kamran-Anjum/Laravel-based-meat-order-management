<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackingController extends Controller
{
    public function packinglogin()
    {
        return view('departments.packing.packing-login');
    }
}
