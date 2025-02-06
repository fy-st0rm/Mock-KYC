<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    @vite("resources/css/app.css")
</head>
<body>
    <div>
        @yield("navbar")
    </div>
    <div>
        @yield('content')
    </div>
</body>
</html>
