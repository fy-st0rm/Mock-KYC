@extends("layouts.master")

@section("title", "Verify")

@section("navbar")
@extends("partials.navbar")
@endsection

@section("content")
    <div class="w-screen h-screen flex items-center justify-center bg-gray-500">
        <div class="bg-gray-300 shadow-lg rounded-lg flex flex-col items-center justify-center p-16">
            <p class="text-black text-4xl font-semibold mb-3"> Verify </p>
            <p class="text-xl"> Your code was sent to you via email </p>

            <form action="{{ route('otp.verify') }}" method="POST" class="items-center justify-center flex flex-col p-10">
                @csrf
                <input type="text" name="otp" placeholder="OTP" class="p-2 rounded bg-gray-200 text-gray-900 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
                <button type="submit" class="w-[50%] bg-blue-300 text-black font-semibold p-2 rounded hover:bg-blue-200 transition shadow-lg">Verify</button>
            </form>

            <div class="flex flex-row space-x-2">
                <p> Didn't receive code? </p>
                <a href="{{ route('otp.resend') }}" class="text-blue-500 underline hover:text-blue-700">
                    Request again
                </a>

            </div>

            @if (session("sucess"))
                <p class="text-green-600 font-semibold">
                    {{ session("sucess") }}
                </p>
            @endif

            @if (session("error"))
                <p class="text-red-600 font-semibold">
                    {{ session("error") }}
                </p>
            @endif
        </div>
    </div>
@endsection
