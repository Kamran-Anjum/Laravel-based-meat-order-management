<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function transportlogin()
    {
        return view('departments.transport.transport-login');
    }
}
