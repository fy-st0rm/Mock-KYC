<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\SendOTP;

class LoginController extends Controller
{
    public function show(): View
    {
        return view("auth.login");
    }

    public function login(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            "email" => "required|email",
            "number" => "required",
        ]);

        $user = User::where("email", $validated["email"])
                    ->where("number", $validated["number"])
                    ->first();

        if ($user) {
            // Generating otp and saving to the user
            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(5);
            $user->save();

            // Authenticating the user (disabling the remember me)
            Auth::login($user, false);

            // Sending OTP email
            Mail::to($user->email)->send(new SendOTP($otp, $user->email));

            return redirect()->intended("home");
        }

        return back()->withErrors([
            'error' => 'Invalid credentials.',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        // Unverifying the user during logout
        $user = Auth::user();
        $user->email_verified_at = null;
        $user->save();

        Auth::logout();
        return redirect()->route("login");
    }
}
