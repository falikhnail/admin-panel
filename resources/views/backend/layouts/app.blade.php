<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name') }}</title>

    @stack('before-styles')

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    @vite('resources/js/backend.js')

    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    @stack('after-styles')
</head>

<body>
    <div id="loadOverlay"
        style="background-color:white; position:absolute; top:0px; left:0px; width:100%; height:100%; z-index:2000;">
    </div>
    <div>
        @include('backend.includes.backend_header')

        @include('backend.includes.backend_sidebar')

        <main id="main" class="main">
            <div class="pagetitle">
                @yield('title_main')
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('backend.dashboard') }}">Home</a></li>
                        @yield('breadcrumb_item')
                    </ol>
                </nav>
            </div>
            <section class="section dashboard">
                <div class="row">
                    @include('flash::message')

                    @yield('content')

                    @include('backend.includes.backend_footer')
                </div>
            </section>
        </main>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>
    </div>

    @stack('before-scripts')

    @livewireScripts

    <script type="text/javascript">
        $(document).ready(function() {
            $('.datepicker').datepicker({
                uiLibrary: 'bootstrap5',
                format: 'yyyy-mm-dd'
            });

            $('.number').on('keydown', (event) => {
                if (event.shiftKey == true) {
                    event.preventDefault();
                }

                if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <=
                        105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event
                    .keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

                } else {
                    event.preventDefault();
                }

                if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190) event.preventDefault();

                //return event.keyCode === 8 || event.charCode >= 48 && event.charCode <= 57;
            });
        });
    </script>

    @stack('after-scripts')

</body>

</html>
