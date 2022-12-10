<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class logoutcontroller extends Controller
{
    //
    public function logOut(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Log Out successfully.',
            'alert-type' => 'success'
        );

        return redirect('/')->with($notification);
    }
}
