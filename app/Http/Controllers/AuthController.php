<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\NewUser;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle login attempt
    public function login(Request $request)
    {
        // Validate the login credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $redirectUrl = session('redirect') ?? '/';
            return redirect($redirectUrl);
        }

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            // Regenerate the session to prevent session fixation
            $request->session()->regenerate();

            // Log the successful login attempt
            Log::info('User logged in successfully: ' . $request->email);

            // Authentication passed; redirect to intended page or dashboard
            return redirect()->intended('/')->with('success', 'You are logged in!');
        }

        // Log the failed login attempt
        Log::warning('Failed login attempt: ' . $request->email);

        // Authentication failed; redirect back with error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle user logout
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('store')->with('success', 'You have been logged out.');
    }

    // Handle user registration
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:createusers,username',
            'email' => 'required|email|unique:createusers,email',
            'password' => 'required|string|confirmed|min:8',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $profilePicturePath = null;

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Create the user
        NewUser::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_picture' => $profilePicturePath,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    // Handle profile update
    public function update(Request $request)
    {
        $userId = Auth::id(); // Alternative method (may be recognized better)
        // Validate the incoming request
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:createusers,username,' . Auth::id(),
            'email' => 'required|email|unique:createusers,email,' . Auth::id(),
            'password' => 'nullable|string|confirmed|min:8',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Get the authenticated user - cast to NewUser model
        /** @var \App\Models\NewUser $user */
        $user = Auth::user();
    
        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        // Handle profile picture upload
        $profilePicturePath = $user->profile_picture; // Keep the old profile picture path by default
    
        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($profilePicturePath && Storage::disk('public')->exists($profilePicturePath)) {
                Storage::disk('public')->delete($profilePicturePath);
            }
    
            // Store the new profile picture
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }
    
        // Update user details
        $user->fullname = $request->fullname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->profile_picture = $profilePicturePath;
        
        $user->save();
    
        // Redirect back with success message
        return redirect()->route('welcome')->with('success', 'Profile updated successfully!');
    }

    public function edit()
    {
    $user = Auth::user();

    $totalListings = \App\Models\Listing::where('user_id', $user->id)->count();
    $totalSold     = \App\Models\Order::where('seller_id', $user->id)->where('status', 'Delivered')->count();
    $totalBought   = \App\Models\Order::where('buyer_id', $user->id)->count();

    return view('profile', compact('totalListings', 'totalSold', 'totalBought'));
    }

    protected function authenticated(Request $request, $user)
    {
        if ($request->has('redirect')) {
            $redirectUrl = $request->input('redirect');
            
            // Check for pending search
            if ($pendingSearch = session()->get('pendingSearch')) {
                $queryString = http_build_query($pendingSearch);
                return redirect($redirectUrl.'?'.$queryString);
            }
            
            return redirect($redirectUrl);
        }
        
        return redirect()->route('home');
    }
}
