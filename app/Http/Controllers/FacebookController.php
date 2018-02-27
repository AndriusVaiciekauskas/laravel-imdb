<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('facebook')->user();
        $fb_user = User::where('fb_id', $user->id)->first();

        if ($fb_user === null) {
            $new_user = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'fb_id' => $user->id
            ]);
            Auth::login($new_user);
            return redirect()->route('main');
        }

        Auth::login($fb_user);
        return redirect()->route('main');
    }
}
