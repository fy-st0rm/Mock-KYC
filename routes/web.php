<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

Route::get("/", [LoginController::class, "show"])->name("login");
Route::post("/login", [LoginController::class, "login"]);

Route::get("/home", function() {
    return view("home");
})->middleware(["auth", "verified"])->name("home");

Route::get("/email/verify", function() {
    return view("auth.verify");
})->middleware("auth")->name("verification.notice");
