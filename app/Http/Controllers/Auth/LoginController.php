<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

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
            Auth::login($user, false);
            return redirect()->intended("home");
        }

        return back()->withErrors([
            'error' => 'The provided credentials do not match our records.',
        ]);
    }
}
