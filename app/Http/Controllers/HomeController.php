<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::guard('web')->check()){
            return view('layouts.dashboard-content');
        }
      return view('welcome');
    }
}
