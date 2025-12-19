<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm() {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'resident') {
                return redirect()->route('resident.dashboard');
            } else {
                Auth::logout();
                return back()->with('error', 'Your account role is not recognized.');
            }
        }

        return back()->with('error', 'Invalid credentials.');
    }

    // Show register form
    public function showRegisterForm() {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|string'
        ]);

        $role = $request->role;

        // If registering as admin, check admin_permissions table
        if ($role === 'admin') {
            $allowed = DB::table('admin_permissions')
                         ->where('email', $request->email)
                         ->exists();

            if (!$allowed) {
                return back()->with('error', 'This email is not authorized to register as admin.');
            }

            $role = 'admin'; // force role to admin
        }

        // Create user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        return redirect()->route('login')->with('success', 'You are now registered. Please log in.');
    }

    // Logout
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
