<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+Bengali+UI&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic"
        rel="stylesheet" type="text/css" />

    @stack('before-styles')

    <script src="{{ asset('js/jquery.min.js') }}"></script>

    @vite(['resources/js/frontend.js'])

    @stack('after-styles')

    @livewireStyles

</head>

<body>
    <div id="loadOverlay"
        style="background-color:#333; position:absolute; top:0px; left:0px; width:100%; height:100%; z-index:2000;">
    </div>
    <div>
        @include('frontend.includes.frontend_header')

        @yield('content')

        @include('frontend.includes.frontend_footer')
    </div>

    @stack('before-scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    @livewireScripts

    @stack('after-scripts')

</body>

</html>
