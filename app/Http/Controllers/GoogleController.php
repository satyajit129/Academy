<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{

    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }

    }

    public function googleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('email', $user->email)->where('google_id', $user->getId())->first();

            Log::info($finduser);

            $folderPath = public_path('images/');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }

            $imageName = uniqid() . '.jpg';
            Log::info($imageName);
            $imageUrl = $user->avatar;

            // Use cURL to fetch image contents more reliably
            $ch = curl_init($imageUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $imageContents = curl_exec($ch);
            curl_close($ch);

            if ($imageContents !== false) {
                file_put_contents($folderPath . $imageName, $imageContents);
            } else {
                $imageName = null; 
            }

            if ($finduser) {
                Log::info('$finduser');
                Log::info($finduser);
                
                $finduser->update([
                    'profile_image' => $imageName,
                ]);

                Auth::login($finduser);
                return redirect()->intended('/');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->getId(),
                    'profile_image' => $imageName,
                    'password' => bcrypt('123456abc'),
                ]);

                Auth::login($newUser);
                return redirect()->intended('/');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
