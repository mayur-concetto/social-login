<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    public function googleAuth()
    {
        return Socialite::driver('google')->redirect();
    }

    public function linkedinAuth()
    {
        return Socialite::driver('linkedin')->redirect();
    }


    public function callbackLinkedin()
    {
        try {
            $link_user = Socialite::driver('linkedin')->user();
            $user = User::where('email', $link_user->getEmail())->first();
            if (!$user) {
                $new_user = User::create([
                    'name' => $link_user->getName(),
                    'email' => $link_user->getEmail(),
                ]);
                Auth::login($new_user);
                return redirect()->intended('home');
            } else {

                Auth::login($user);
                return redirect()->intended('home');
            }
        } catch (\Throwable $th) {
            dd("something went wrong" . $th->getMessage());
        }
    }
    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('google_id', $google_user->getId())->first();
            if (!$user) {
                $new_user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId(),

                ]);

                Auth::login($new_user);
                return redirect()->intended('home');
            } else {
                echo "hellodfdf";
                die;
                Auth::login($user);
                return redirect()->intended('home');
            }
        } catch (\Throwable $th) {
            dd("something went wrong" . $th->getMessage());
        }
    }
}
