<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function show(): View
    {
        $user = Auth::user();

        return view("home")->with(["user" => $user]);
    }
}
