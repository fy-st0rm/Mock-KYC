@extends("layouts.master")

@section("title", "OTP")

@section("content")
    <div class="w-screen h-screen flex items-center justify-center bg-gray-500">
        <div class="bg-gray-300 shadow-lg rounded-lg flex flex-col items-center justify-center p-10">
            <p class="text-black text-4xl font-semibold mb-10"> Verify Your Login </p>
            <p> Use this OTP to login to your account </p>
            <p> This code will expire in 5 minutes </p>

            <p class="text-green-500 text-5xl font-semibold my-7" style="letter-spacing: 1rem;"> {{ $otp }} </p>

            <p> This code will securely login to your profile using </p>
            <p class="text-blue-500"> {{ $email }} </p>
        </div>
    </div>
@endsection
