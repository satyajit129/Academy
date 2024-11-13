<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use App\Models\User;
use App\Models\UserCustomExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        return view('custom.pages.auth.login');
    }

    public function loginRequest(Request $request)
    {
        try {
            $credentials = $request->only('identifier', 'password');
            $remember = $request->has('remember');
            $validator = Validator::make($credentials, [
                'identifier' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $fieldType = filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
            if (Auth::attempt([$fieldType => $credentials['identifier'], 'password' => $credentials['password']], $remember)) {
                $user = Auth::user();
                if ($user->role === UserRole::USER->value) {
                    return redirect()->intended('/');
                } else {
                    Auth::logout();
                    return back()->with('error', 'Access denied. Admins cannot log in here.');
                }
            }
            return back()->with('error', 'Invalid credentials');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function register()
    {
        return view('custom.pages.auth.register');
    }
    public function registerRequest(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|regex:/^(01)[3-9]\d{8}$/|unique:users,phone',
                'password' => 'required|min:6',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = bcrypt($request->password);
            $user->save();

            Auth::login($user);
            return redirect()->intended('/');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

    }
    public function profile()
    {
        $user = Auth::user();
        return view('custom.pages.auth.profile', compact('user'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function resume()
    {
        return view('custom.pages.auth.resume');
    }
    public function myExam()
    {
        $user_custom_exams = UserCustomExam::where('user_id', Auth::user()->id)->get();
        // Cast `final_score` and `cut_marks` to integers for accurate comparison
        $passed_count = $user_custom_exams->filter(function($exam) {
            return (int)$exam->final_score >= (int)$exam->cut_marks;
        })->count();

        $failed_count = $user_custom_exams->filter(function($exam) {
            return (int)$exam->final_score < (int)$exam->cut_marks;
        })->count();
        
        return view('custom.pages.auth.my-exam', compact('user_custom_exams', 'passed_count', 'failed_count'));
    }
}
