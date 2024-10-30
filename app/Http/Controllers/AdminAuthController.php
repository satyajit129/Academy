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
        dd($request->all());
        try {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user->role == UserRole::ADMIN) {
                    return redirect()->route('adminDashboard')->with('success', 'Welcome to the Dashboard!');
                } else {
                    Auth::logout(); // Log out if the user isn't an admin
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
}
