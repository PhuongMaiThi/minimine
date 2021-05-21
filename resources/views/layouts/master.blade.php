<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Home Page')</title>
    {{-- css --}}
    @include('layouts.css')
</head>
<body>
    {{-- header --}}
    @include('layouts.header')

    {{-- navigation --}}
    {{-- @include('layouts.navigation_custom') --}}

    {{-- menu --}}
    @include('layouts.menu')

    {{-- content --}}
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- footer --}}
    @include('layouts.footer')

    {{-- js --}}
    @include('layouts.js')
</body>
</html>