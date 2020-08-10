
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="Rivela developer network">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>{{config('app.name')}}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/bootstrap/4.3.1/css/bootstrap.min.css')}}" rel="stylesheet" >

    <!-- App stylesheet -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet" >


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    
  </head>
<body>
  <div id="app">
    
    @yield('main-nav')
    <main class="py-4 main-content">
        @yield('content')
    </main>

</div>
<!-- Scripts -->
<script src="{{asset('assets/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/validator/validator.min.js')}}"></script>
<script src="{{asset('assets/dataTables/datatables.min.js')}}"></script>
<script src="{{asset('assets/jquery-3.3.1.slim.min.js')}}" ></script>     
<script src="{{asset('assets/bootstrap/4.3.1/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
 </body>
</html>
