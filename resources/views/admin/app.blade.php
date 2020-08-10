
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/bootstrap/4.3.1/css/bootstrap.min.css')}}" rel="stylesheet" >
    <link href="{{asset('assets/datatables/datatables.min.css')}}" rel="stylesheet" >
    <link href="{{asset('assets/jquery/jquery-confirm.min.css')}}" rel="stylesheet" >

    {{-- Fontawesome css--}}
    <link href="{{asset('assets/fontawesome/css/all.css')}}" rel="stylesheet" >
    @yield('assets_css')

    <!-- Admin stylesheet -->
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet" >

    {{-- javascript plugins --}}
    <script src="{{asset('assets/jquery/jquery-3.4.0.min.js')}}"></script>
    <script src="{{asset('assets/jquery/jquery-confirm.min.js')}}"></script>
    <script src="{{asset('assets/validator/validator.min.js')}}"></script>
    <script src="{{asset('assets/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/datatables/handlebars.js')}}"></script> 
    <script src="{{asset('assets/bootstrap/4.3.1/js/bootstrap.bundle.min.js')}}"></script>
    @yield('assets_js')
   


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
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">{{config('app.name')}}</a>
      <input class="form-control form-control-dark w-50" type="text" placeholder="Search" aria-label="Search">

      @if (Route::has('login'))
      <div class="pull-right login">
        @auth
          <a href="{{ url('/admin') }}">Admin</a>
        @else
          <a href="{{ route('login') }}">Login</a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
          @endif
        @endauth
      </div>
      @endif  
  </nav>

<div class="container-fluid">
  <div class="row">
    @include('admin.sidebar')
      @yield('admin.sidebar')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      @yield('content_header')
      @yield('content')
         
    </main>
  </div>
</div>

 @yield('js_body')
</body>
</html>
