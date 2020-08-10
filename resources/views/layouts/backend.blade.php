<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Inspektorat Daerah Kab. Sidoarjo') }}</title>

        <!-- Favicon -->
        <link href="{{ asset('assets/img/brand/logo_dinas.png') }}" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('assets/css/argon.css?v=1.0.0') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/jquery/jquery-confirm.min.css') }}" rel="stylesheet">
        @stack('css')

        <!-- JS files -->
        <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"> </script>
        <script src="{{ asset('assets/vendor/jquery/jquery-ui.min.js') }}"> </script>
        <script src="{{ asset('assets/vendor/jquery/jquery-confirm.min.js') }}"> </script>
        <script src="{{ asset('assets/vendor/bootstrap/dist/js/popper.min.js') }}"> </script>
        <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"> </script>

        @stack('js')
        
        <!-- Argon JS -->
        <!-- <script src="{{ asset('assets/js/argon.js?v=1.0.0') }}"></script> -->
        <script src="{{ asset('js/rivela.js') }}"></script>
        
       
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @if(config('rivela.dashboard_sidebar') == true)
                @role('Admin')
                    @include('admin.navbars.sidebar')
                @else
                    @include('layouts.navbars.sidebar')
                @endrole
            @endif
        @endauth
        
        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest
        <script type="text/javascript">
            //dragable modal
            $('.modal-dialog').draggable({
                handle: '.modal-content'
              });
        </script>
    </body>
</html>
