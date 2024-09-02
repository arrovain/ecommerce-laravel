<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthAdminRequest;

class AdminController extends Controller
{
   
    public function index()
    {
        return view('admin.index');
    }

  
    public function login()
    {
        if (!auth()->guard('admin')->check()) {
            return view('admin.login');
        }

        return redirect()->route('admin.index');
    }

 
    public function auth(AuthAdminRequest $request)
    {
        if($request->validated()) {
            if(auth()->guard('admin')->attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                $request->session()->regenerate();
                return redirect()->route('admin.index');
            }else {
                return redirect()->route('admin.login')->with([
                    'error' => 'These credentials do not match any of our records.'
                ]);
            }
        }
    }

  
    public function logout()
    {
        auth()->guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}