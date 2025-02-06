@extends("layouts.master")

@section("title", "login")

@section("content")
    <div class="w-screen h-screen flex items-center justify-center bg-gray-500">
        <div class="bg-gray-300 shadow-lg rounded-lg flex flex-col items-center justify-center p-20">
            <p class="text-black text-4xl font-semibold mb-16"> Login to KYC </p>
            <form action="/login" method="POST" class="w-full flex flex-col">
                @csrf
                <input type="email" name="email" placeholder="Email" class="p-2 rounded bg-gray-200 text-gray-900 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
                <input type="text" name="number" placeholder="Phone number" class="p-2 rounded bg-gray-200 text-gray-900 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
                <button type="submit" class="bg-white text-black font-semibold p-2 rounded hover:bg-blue-200 transition shadow-lg">Login</button>
            </form>

            {{-- Display error message --}}
            @error("error")
                <div class="w-full bg-red-500 text-white p-2 rounded mb-3 mt-3 text-center">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
@endsection

