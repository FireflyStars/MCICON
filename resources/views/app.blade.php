<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>MICON</title>
        {{--  Favicon  --}}
        <link rel="icon" href="{{asset('image/favicon.png')}}">
        <link href="{{ asset('css/icons.css') }}"  rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <!-- Pre-loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">Loading...</div>
            </div>
        </div>
        <!-- End Preloader-->        
        <div id="app"></div>
        
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            $(window).on('load', function () {
                $('#preloader').delay(500).fadeOut('slow');
            });
        </script>        
    </body>
</html>
