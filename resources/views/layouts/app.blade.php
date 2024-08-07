<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- styles --}}
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    @yield('styles')
    <title>{{ $title }}</title>
</head>

<body class="bg-body-secondary poppins-regular">

    <x-navbar></x-navbar>
    <div class="container mb-5"">
        @yield('content')
    </div>
    <x-footer></x-footer>


    {{-- scripts --}}
    @vite('resources/js/app.js')
</body>

</html>
