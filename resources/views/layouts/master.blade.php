<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Home Page')</title>
    {{-- css --}}
    <!-- Head Contents -->
       <!-- // <link rel="stylesheet" href="resources/css/category.css"> -->
    @include('layouts.css')

</head>
<body>
    <!-- {{-- header --}} -->

    @include('layouts.header')

    

    <!-- {{-- menu --}} -->

    @include('layouts.menu')

    

    <!-- {{-- content--}} -->

    <div class="container">
        
    @yield('content') 

    
    </div>
    <!-- {{-- footer --}} -->

    @include('layouts.footer')
    
</body>
</html>