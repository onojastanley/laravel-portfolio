<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function login()
    {

      return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
                 $notification = array(
            'message' => 'User Login Successfully',
            'alert-type' => 'success'
        );
            return redirect()->intended('dashboard')->with($notification);
        }
        $notification = array(
            'message' => 'User Login Failed',
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }

    public function logout() {
        Auth::logout();
        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
      }

    public function home()
    {

      return view('home');
    }
}
