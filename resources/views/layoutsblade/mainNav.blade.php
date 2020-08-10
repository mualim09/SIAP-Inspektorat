@section('main-nav')
<nav class="navbar navbar-dark bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{url('/')}}">{{config('app.name')}}</a>
    <input class="form-control form-control-dark w-80" type="text" placeholder="Search" aria-label="Search">
    @if (Route::has('login'))
        <div class="pull-right login-regis">
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
@endsection