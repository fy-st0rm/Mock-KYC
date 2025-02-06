<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use App\Mail\SendOTP;

class OTPController extends Controller
{
    public function show(): View
    {
        return view("auth.verify");
    }

    public function verify(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            "otp" => "required|numeric"
        ]);

        $user = Auth::user();
        if ($user->otp !== $validated["otp"] ||
            Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->with("error", "Invalid or expired otp");
        }

        // Marking the user as verified
        $user->email_verified_at = now();
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return redirect()->route("home");
    }

    public function resend(): RedirectResponse
    {
        $otp = rand(100000, 999999);

        // Saving the new otp
        $user = Auth::user();
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(5);
        $user->save();

        // Sending the new email
        Mail::to($user->email)->send(new SendOTP($otp, $user->email));

        return back()->with("sucess", "Sucessfully sent a new otp.");
    }
}
