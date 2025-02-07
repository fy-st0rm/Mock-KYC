<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function show(): View
    {
        $user = Auth::user();
        return view("home")->with(["user" => $user]);
    }

    public function update(Request $request): RedirectResponse
    {
        // Personal Data Validation
        $personalDataValidation = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'number' => 'required|string|size:14',
            'gender' => 'required|string',
            'dob' => 'required|date',
            'nationality' => 'required|string',
            'address' => 'required|string',
        ]);

        // Government Data Validation
        $governmentDataValidation = $request->validate([
            'id_type' => 'required|string',
            'id_number' => 'required|string',
            'issued_country' => 'required|string',
        ]);

        // Getting authenticated user
        $user = Auth::user()->load("governmentData");
        $govData = $user->governmentData;

        // Updating personal data
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->number = $request->input('number');
        $user->gender = $request->input('gender');
        $user->dob = $request->input('dob');
        $user->nationality = $request->input('nationality');
        $user->address = $request->input('address');
        $user->save();

        // Update government data
        if ($govData) {
            $govData->id_type = $request->input('id_type');
            $govData->id_number = $request->input('id_number');
            $govData->issued_country = $request->input('issued_country');
            $govData->save();
        } else {
            return back()->withErrors(['error' => 'Government data not found']);
        }

        return back()->with("sucess", "Sucessfully updated profile.");
    }
}
