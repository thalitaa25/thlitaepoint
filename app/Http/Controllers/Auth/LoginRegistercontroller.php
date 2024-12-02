<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegistercontroller extends Controller{
    public function register()
    {
        return view('auth.register');
    }
    
    public function store(request $request)
    {
        $request->validate([
            'name'=>'required|string|max:250',
            'email' =>'required|email|max:250|unique:users',
            'password'=>'required|min:8|confirmed'
    ]);
    
    User::create([
    'name'=> $request->name,
    'email'=> $request->email,
    'password'=> Hash::make($request->password),
    'usertype' => 'admin'
    ]);
    $credentials =$request->only('email','password');
    auth::attempt($credentials);
    $request->session()->regenerate();
    if ($request->user()->usertype = 'admin'){
        return redirect('admin/dashboard')->withSuccess('you have successfully registered $ logged in!');
    
    }
    return redirect()->intended(route('dashboard'));
    }
    public function login()
    {
        return view('auth.login');
    }
    public function authenticate(request $request)
    {
        $credentials = $request ->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
    if (Auth::attempt($credentials)) {
        $request ->session()->regenerate();
        if ($request->user()->usertype == 'admin'){
            return redirect('admin/dashboard')->withSuccess('you have succesfully loget in!');
        }
    }
    return back()->withErrors([
        'email'=>'your provided credentials do not match in our records',
    ])->onlyInput('email');
    }
        public function logout(request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
        ->withSuccess('you have logged out successfully!');;
    
    }
}
  
