<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

Route::get("/", [LoginController::class, "show"])->name("login");
Route::post("/login", [LoginController::class, "login"]);

Route::middleware(["auth", "verified"])->group(function () {
    Route::get("/home", function() {
        return view("home");
    })->name("home");
});

Route::middleware("auth")->group(function () {
    Route::get("/logout", [LoginController::class, "logout"])->name("logout");
    Route::get("/email/verify", function() {
        return view("auth.verify");
    })->name("verification.notice");
});
