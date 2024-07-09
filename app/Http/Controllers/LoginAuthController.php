<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LoginAuthController extends Controller
{
    public function getLogin()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
    
        return view('login');
    }
    
    protected function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $validatedAdmin = auth()->attempt([
            'username' => $request->username,
            'password' => $request->password,
        ]);

        if ($validatedAdmin) {
            $route = (auth()->user()->role == "Administrator") || (auth()->user()->role == "Records Officer") ? 'dashboard' : 'drive';
            return redirect()->route($route)->with('success', 'Login Successfully');
        }else {
            return redirect()->back()->with('error', 'Invalid Credentialss');
        }
    }
    
}
