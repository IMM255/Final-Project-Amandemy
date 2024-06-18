<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function login(){
        return view('pages.auth.login');
    }

    public function register(){
        return view('pages.auth.register');
    }

    public function registerProcess(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:225',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return redirect()->route('login')
                ->with('success', 'Register Berhasil Silahkan Login');
        } else {
            return redirect()->route('register')
                ->with('error', 'Failed to create user');
        }
    }

    public function loginProcess(Request $request)
    {
        $credentials =  $request->validate([
            'email' => 'required|email',
            'password' => 'required|',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('dashboard');
            } elseif ($user->role === 'masyarakat') {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')
                ->with('error', 'Login failed: username or password is incorrect');
        }

    }
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
