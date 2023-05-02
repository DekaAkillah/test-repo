<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function registration(){
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => Str::title($request->name),
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // return redirect()->route('dashboard.index');

        return $this->authenticate($request);
    }

    public function forgotPassword(){
        return view('auth.forgot-password', [
            'title' => 'Forgot Password'
        ]);
    }
    
    public function verifyEmail(){
        return view('auth.verify-email', [
            'title' => 'Verify Email'
        ]);
    }
    
    public function authenticate(Request $request){
        $cred = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($cred)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('authError', 'Wrong email or password!');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
