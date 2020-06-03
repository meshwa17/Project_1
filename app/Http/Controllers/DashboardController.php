<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
    	# code...
    	$this->middleware('web');
    }
    public function dashboard()
    {
    	return view('layouts.master');
    }
}
