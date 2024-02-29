<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Login;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function create()
    {
        return response()->json();
    }

    public function login(Request $request)
    {
        
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            Login::create([
                'user_id' => auth()->user()->id,
                'ip_address' => $request->ip(),
                'email_id' => auth()->user()->email_id,
                'location' => auth()->user()->location
            ]);
            return response()->json(['message' => 'Success', 'user' => $user]);
        }




        return response()->json(['error' => 'Invalid Credentials'], 401);
    }

    public function logout(Request $request)
    {
        Login::where('user_id', auth()->user()->id)
            ->latest()
            ->limit(1)
            ->update(['logout_time' => now()]);

        auth()->logout();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
