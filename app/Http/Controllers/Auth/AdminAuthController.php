<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function register(Request $request)
    {
    }

    public function login(Request $request)
    {
        return view('auth.admin-login');
    }
    // public function loginAction(Request $request)
    // {

    //     if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password,'type'=>'admin'])){

    //         return redirect()->route('dashboard');
    //     }else {
    //         return back()->with('error','credentials does not match');
    //     }

    // }

}
