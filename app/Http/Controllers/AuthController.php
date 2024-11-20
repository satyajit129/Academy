<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use App\Models\User;
use App\Models\UserCustomExam;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        if ($user) {
            $education = json_decode($user->education, true);
            $experience = json_decode($user->experience, true);
            $languages = json_decode($user->language, true);
            $socialLinks = json_decode($user->social_links, true);
        }
        // dd($education, $experience, $languages, $socialLinks);
        return view('custom.pages.auth.profile', compact('user', 'education', 'experience', 'languages', 'socialLinks'));
    }
    public function profileEdit(Request $request)
    {
        $user_id = request('userId');
        $user_info = User::find($user_id);
        return view('custom.pages.auth.profile_edit', compact('user_info'));
    }
    public function profileUpdate(Request $request, $id)
    {
        // dd('okkk');
        try {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'date_of_birth' => 'required|date',
                'gender' => 'required|in:1,2,3',
                'nationality' => 'required',
                'career_objective' => 'nullable',
            ]);

            $user = User::find($id);
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }

            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->date_of_birth = $request->input('date_of_birth');
            $user->gender = $request->input('gender');
            $user->nationality = $request->input('nationality');
            $user->career_objective = $request->input('career_objective');
            $user->save();

            return redirect()->back()->with('success', 'Profile updated successfully');

        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->errors())->withInput();

        } catch (Exception $e) {
            Log::info($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function additionalInfoEdit(Request $request)
    {
        $data = $request->data;
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        if ($user && !empty($user->$data)) {
            $decodedData = json_decode($user->$data, true);
            return view('custom.pages.auth.additional_info_edit', compact('data', 'user', 'decodedData'));
        }
        return view('custom.pages.auth.additional_info_edit', compact('data', 'user'));
    }

    public function additionalInfoUpdate(Request $request, $id)
    {
        $validationRules = [
            'education' => [
                'degree' => 'required|array',
                'degree.*' => 'required|string',
                'year' => 'required|array',
                'year.*' => 'required|string',
                'grade_point' => 'required|array',
                'grade_point.*' => 'required|string',
            ],
            'experience' => [
                'company_name' => 'required|array',
                'company_name.*' => 'required|string',
                'position' => 'required|array',
                'position.*' => 'required|string',
                'start_date' => 'required|array',
                'start_date.*' => 'required|string',
                'end_date' => 'required|array',
                'end_date.*' => 'required|string',
            ],
            'language' => [
                'language' => 'required|array',
                'language.*' => 'required|string',
                'proficiency' => 'required|array',
                'proficiency.*' => 'required|string',
            ],
            'social_links' => [
                'platform' => 'required|array',
                'platform.*' => 'required|string',
                'link' => 'required|array',
                'link.*' => 'required|string',
            ],
        ];
        if (in_array($request->type, array_keys($validationRules))) {
            $validated = $request->validate($validationRules[$request->type]);
            $data = $this->processAndSaveData($request, $id, $request->type);
            if ($data) {
                return redirect()->back()->with('success', ucfirst($request->type) . ' information updated successfully.');
            }
        }
        return redirect()->back()->with('error', 'Failed to update information.');
    }

    private function processAndSaveData($request, $id, $type)
    {
        $fieldsMapping = [
            'education' => ['degree', 'year', 'grade_point'],
            'experience' => ['company_name', 'position', 'start_date', 'end_date'],
            'language' => ['language', 'proficiency'],
            'social_links' => ['platform', 'link'],
        ];
        if (!isset($fieldsMapping[$type])) {
            return false;
        }
        $data = [];
        $fields = $fieldsMapping[$type];

        $count = count($request->{$fields[0]});
        for ($i = 0; $i < $count; $i++) {
            $entry = [];
            foreach ($fields as $field) {
                $entry[$field] = $request->{$field}[$i];
            }
            $data[] = $entry;
        }
        $jsonData = json_encode($data);
        $user = User::find($id);
        if ($user) {
            $user->{$type} = $jsonData;
            $user->save();
            return true;
        }

        return false;
    }

    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'image_base64' => 'required|string',
        ],[
            'image_base64.required' => 'দয়া করে ছবি সিলেক্ট করুন।'
        ]);
        $base64Image = $request->input('image_base64');
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
            $data = substr($base64Image, strpos($base64Image, ',') + 1);
            $type = strtolower($type[1]);
            $data = base64_decode($data);

            if ($data === false) {
                return redirect()->back()->with('error', 'Base64 decoding failed');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid image data');
        }
        $fileName = uniqid() . '.' . $type;
        $publicPath = public_path('images');
        if (!file_exists($publicPath)) {
            mkdir($publicPath, 0755, true);
        }
        $filePath = $publicPath . '/' . $fileName;
        file_put_contents($filePath, $data);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->profile_image = $fileName;
        $user->save();
        return redirect()->back()->with('success', 'Profile image updated successfully');
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
        $passed_count = $user_custom_exams->filter(function ($exam) {
            return (int) $exam->final_score >= (int) $exam->cut_marks;
        })->count();

        $failed_count = $user_custom_exams->filter(function ($exam) {
            return (int) $exam->final_score < (int) $exam->cut_marks;
        })->count();

        return view('custom.pages.auth.my-exam', compact('user_custom_exams', 'passed_count', 'failed_count'));
    }
}
