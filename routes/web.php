<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OTPController;

Route::get("/", [LoginController::class, "show"])->name("login");
//Route::get("/", function() {
//    return view("emails.otp")->with(["otp" => "123456", "email" => "asd@gmail.com"]);
//});
Route::post("/login", [LoginController::class, "login"]);

Route::middleware(["auth", "verified"])->group(function () {
    Route::get("/home", [HomeController::class, "show"])
        ->name("home");

    Route::post("/user/update", [HomeController::class, "update"])
        ->name("user.update");
});

Route::middleware("auth")->group(function () {
    Route::get("/logout", [LoginController::class, "logout"])
        ->name("logout");

    Route::get("/otp/verify", [OTPController::class, "show"])
        ->name("verification.notice");
    Route::post("/otp/verify", [OTPController::class, "verify"])
        ->name("otp.verify");
    Route::get("/otp/resend", [OTPController::class, "resend"])
        ->name("otp.resend");
});
