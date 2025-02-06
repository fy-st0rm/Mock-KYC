<!-- resources/views/partials/navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-gray-300">
    <div class="container-fluid flex justify-between items-center p-2">
        <form action="/logout" method="GET" class="ml-auto mb-0">
            <button type="submit" class="bg-white text-red-500 font-semibold p-2 rounded hover:bg-blue-200 transition shadow-lg">Logout</button>
        </form>
    </div>
</nav>
