<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
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
}
