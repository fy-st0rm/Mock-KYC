@extends("layouts.master")

@section("title", "Home")

@section("navbar")
@extends("partials.navbar")
@endsection

@section("content")
<div class="w-screen h-screen flex items-center justify-center bg-gray-500">
    <div class="bg-gray-300 shadow-lg rounded-lg items-center justify-center flex flex-col py-10 px-20">
        <!-- Tabs Navigation -->
        <div class="flex">
            <button onclick="openTab('personal')" id="defaultTab"
                class="tab-button py-2 px-4 border-b-2 font-medium text-gray-600 focus:outline-none">
                Personal Info
            </button>
            <button onclick="openTab('government-info')"
                class="tab-button py-2 px-4 border-b-2 font-medium text-gray-600 focus:outline-none">
                Government Info
            </button>
        </div>

        <!-- Form -->
        <form method="POST" class="mt-10">
            @csrf

            <!-- Personal Info -->
            <div id="personal" class="tab-content space-y-4">
                <div class="flex items-center gap-4">
                    <span class="text-gray-700 w-32">Name:</span>
                    <input type="text" name="name"
                        class="flex-1 border-0 border-b-2 border-gray-600 bg-gray-300 focus:ring-0 focus:border-blue-500 outline-none p-1"
                        value="{{ $user->name }}"
                        required>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-gray-700 w-32">Email:</span>
                    <input type="email" name="email"
                        class="flex-1 border-0 border-b-2 border-gray-600 bg-gray-300 focus:ring-0 focus:border-blue-500 outline-none p-1"
                        value="{{ $user->email }}"
                        required>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-gray-700 w-32">Phone Number:</span>
                    <input type="text" name="number" maxlength="14"
                        class="flex-1 border-0 border-b-2 border-gray-600 bg-gray-300 focus:ring-0 focus:border-blue-500 outline-none p-1"
                        value="{{ $user->number }}"
                        required>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-gray-700 w-32">Gender:</span>
                    <select name="gender"
                        class="flex-1 border-0 border-b-2 border-gray-600 bg-gray-300 focus:ring-0 focus:border-blue-500 outline-none p-1">
                        <option value="" selected disabled>Choose</option>
                        <option value="male"   {{ $user->gender == 'male'   ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other"  {{ $user->gender == 'other'  ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-gray-700 w-32">Date of Birth:</span>
                    <input type="date" name="dob"
                        class="flex-1 border-0 border-b-2 border-gray-600 bg-gray-300 focus:ring-0 focus:border-blue-500 outline-none p-1"
                        value="{{ $user->dob->format('Y-m-d') }}"
                        required>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-gray-700 w-32">Nationality:</span>
                    <input type="text" name="nationality"
                        class="flex-1 border-0 border-b-2 border-gray-600 bg-gray-300 focus:ring-0 focus:border-blue-500 outline-none p-1"
                        value="{{ $user->nationality }}"
                        required>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-gray-700 w-32">Address:</span>
                    <input type="text" name="address"
                        class="flex-1 border-0 border-b-2 border-gray-600 bg-gray-300 focus:ring-0 focus:border-blue-500 outline-none p-1"
                        value="{{ $user->address }}"
                        required>
                </div>
            </div>

            <!-- User Government Data -->
            <div id="government-info" class="tab-content space-y-4">
                <div class="flex items-center gap-4">
                    <span class="text-gray-700 w-32">ID Type:</span>
                    <select name="id_type"
                        class="flex-1 border-0 border-b-2 border-gray-600 bg-gray-300 focus:ring-0 focus:border-blue-500 outline-none p-1" required>
                        <option value="" selected disabled>Choose ID Type</option>
                        <option value="Passport"       {{ $user->governmentData->id_type == 'Passport'       ? 'selected' : '' }}>Passport</option>
                        <option value="National ID"    {{ $user->governmentData->id_type == 'National ID'    ? 'selected' : '' }}>National ID</option>
                        <option value="Driver License" {{ $user->governmentData->id_type == 'Driver License' ? 'selected' : '' }}>Driver License</option>
                    </select>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-gray-700 w-32">ID Number:</span>
                    <input type="text" name="id_number"
                        class="flex-1 border-0 border-b-2 border-gray-600 bg-gray-300 focus:ring-0 focus:border-blue-500 outline-none p-1"
                        value="{{ $user->governmentData->id_number }}"
                        required>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-gray-700 w-32">Issued Country:</span>
                    <input type="text" name="issued_country"
                        class="flex-1 border-0 border-b-2 border-gray-600 bg-gray-300 focus:ring-0 focus:border-blue-500 outline-none p-1"
                        value="{{ $user->governmentData->issued_country }}"
                        required>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex">
                <button type="submit" class="ml-auto bg-blue-500 text-white px-4 py-2 rounded shadow">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Tab Navigation -->
<script>
    function openTab(tabName) {
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });

        // Show the selected tab content
        document.getElementById(tabName).classList.remove('hidden');

        // Update active tab button style
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('border-blue-500', 'text-blue-500');
        });
        event.target.classList.add('border-blue-500', 'text-blue-500');
    }

    // Open default tab on page load
    document.getElementById('defaultTab').click();
</script>
@endsection
