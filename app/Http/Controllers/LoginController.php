<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function signup(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string|unique:customers,username',
            'password' => 'required|string',
        ]);

        $customer = new Customer;
        $customer->username = $credentials['username'];
        $customer->password = Hash::make($credentials['password']);
        $customer->save();

        return redirect('auth/login')->with('flash', 'User registered!');
    }

    /**
     * Logs in the user
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->flash('flash', 'Login successful');
            return redirect()->intended('landing');
        } else {
            $request->session()->flash('flash', 'User login attempt failed');
            return redirect()->intended('auth/login');
        }
    }

    /**
     * Log out
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('auth/login')->with('flash', 'User logged out');
    }
}
