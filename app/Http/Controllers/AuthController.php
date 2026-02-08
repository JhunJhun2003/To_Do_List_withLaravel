<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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

    // Show password reset request form
    public function showPasswordRequest()
    {
        return view('passwordrequest');
    }


    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        try {
            // 1. Generate unique token
            $token = Str::random(64);
            
            // 2. Store token in database
            DB::table('password_resets')->updateOrInsert(
                ['email' => $request->email],
                [
                    'token' => Hash::make($token),
                    'created_at' => now()
                ]
            );

            // 3. Create reset link
            $resetLink = url('/reset-password/' . $token . '?email=' . urlencode($request->email));

            // 4. Send email with proper HTML template
            $emailData = [
                'resetLink' => $resetLink,
                'email' => $request->email,
                'appName' => config('app.name', 'TodoList App'),
                'expiryTime' => '60 minutes'
            ];

            Mail::send('emails.password-reset', $emailData, function($message) use ($request) {
                $message->to($request->email);
                $message->subject('Password Reset Request - ' . config('app.name', 'TodoList'));
                $message->from(
                    config('mail.from.address', 'noreply@noretodolist.asia'),
                    config('mail.from.name', config('app.name'))
                );
            });

            // 5. Return success
            return back()->with('success', 'Password reset link has been sent to your email! Check Mailpit at http://localhost:8025');

        } catch (\Exception $e) {
            // Log error for debugging
            Log::error('Password reset error: ' . $e->getMessage());
            
            return back()->withErrors([
                'email' => 'Failed to send reset link. Error: ' . $e->getMessage()
            ]);
        }
    }
    // edit profile section
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
            'email' => 'required|email|unique:users,email,'.$user->id,
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
