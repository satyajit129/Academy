<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class AdminAuthController extends Controller
{
    public function adminAuth()
    {
        return view('backend.pages.auth.login');
    }
    public function adminLoginRequest(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                // dd($user->role);
                if ($user->role === UserRole::ADMIN->value) {
                    return redirect()->route('adminDashboard')->with('success', 'Welcome to the Dashboard!');
                } else {
                    // dd('okkk');
                    Auth::logout();
                    return redirect()->back()->with('error', 'You are not authorized to access the Dashboard');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid credentials');
            }
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'An error occurred during login');
        }
    }
    public function adminLogout()
    {
        Auth::logout();
        return redirect()->route('adminAuth');
    }
}
