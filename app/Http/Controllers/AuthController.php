<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show register form
    public function showRegister()
    {
        return view('register');
    }

    // Handle register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // $user->save();
        Auth::login($user);

        return redirect()->route(route: 'home')->with('success', 'Account created!');
    }

    // Show login form
    public function showLogin()
    {
        return view('login');
    }

    // Handle login
    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();

    //         return redirect()->route('home');
    //     }

    //     return redirect()->route('login')->withErrors([
    //         'email' => 'Invalid credentials.',
    //     ]);
    // }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Add remember me functionality
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('home')->with('success', 'Welcome back!');
        }

        // Return with error and preserve email
        return back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'Invalid email or password.',
            ]);
    }

    // Logout
    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect()->route('login');
    // }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    //edit profile section
    public function showEditProfile($id)
    {
        $user = User::findOrFail($id);
        return view('component.editprofile', compact('user'));
    }

    public function updatedprofile(Request $request, $id)
    {
        
        $user = User::findOrFail($id);
        // dd($user->name);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id
        ]);
// dd($user->name);
        $user->name = $request->name;
        $user->email = $request->email;
        // if ($request->filled('password')) {
        //     $user->password = Hash::make($request->password);
        // }
        
        $user->save();

        return redirect()->route('home')->with('success', 'Profile updated!');
    }
}
