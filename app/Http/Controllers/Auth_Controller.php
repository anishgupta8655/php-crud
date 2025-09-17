<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Auth_Controller extends Controller
{
    // Show Login Page
    public function login()
    {
        return view('auth.login');
    }

    // Show Register Page
    public function register()
    {
        return view('auth.resister'); // ✅ fixed typo
    }

    // Handle Register
    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:30|confirmed'
        ]);

        $user = new User();
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    // Handle Login (without Auth facade)
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:30'
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Store user manually in session
            session(['user' => $user]);

            return redirect()->route('products.index')->with('success', 'Login successful.');
        }

        return back()->with('error', 'Invalid email or password.');
    }

    // Dashboard (after login)
    public function dashboard()
    {
        if (!session()->has('user')) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        return view('dashboard');
    }

    // Logout
    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
