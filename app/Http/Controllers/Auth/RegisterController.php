<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class RegisterController extends Controller
{
    public function register()
      {

        return view('auth.register');
      }

      public function store(Request $request)
      {
          $request->validate([
              'name' => 'required|string|max:255',
              'username' => ['required', 'string','max:255', 'unique:users'],
              'email' => 'required|string|email|max:255|unique:users',
              'password' => 'required|string|min:8|confirmed',
              'password_confirmation' => 'required',
          ]);

          User::create([
              'name' => $request->name,
              'username' => $request->username,
              'email' => $request->email,
              'password' => Hash::make($request->password),
          ]);

          return redirect('login');
      }
}
