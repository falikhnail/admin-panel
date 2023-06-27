<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;900&display=swap">

    @stack('before-styles')

    @vite('resources/js/auth.js')

    <style>
        .body-bg-auth {
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%),
                url("{{ asset('img/bisnis.jpg') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-size: cover;
        }
    </style>

    @stack('after-styles')
</head>

<body>
    <div id="loadOverlay"
        style="background-color:white; position:absolute; top:0px; left:0px; width:100%; height:100%; z-index:2000;">
    </div>
    <div class="font-sans text-gray-900 antialiased">
        @yield('content')
    </div>
</body>

</html>
