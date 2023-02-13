<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
   public function index(){

    $user=User::all();

       return view('users')->with(['users'=>$user]);
   }
   /**
     * Display the user's profile form.
     */
    public function edit($id): View
    {
        $user=User::find($id);
        return view('users-edit')->with(['user' => $user]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'is_active' => 'required|int',
        ]);

        User::where('id',$request->id)->update(['is_active'=>$request->is_active]);

        return Redirect::route('admin.users')->with('status', 'updated');
    }
}
