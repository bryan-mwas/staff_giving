<html>
<head>
    <title>Staff Awards - @yield('title')</title>
    <!-- style sheets go here -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Strathmore University</a>

    <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav mr-auto mt-2 mt-md-0"></ul>
        <form class="form-inline my-2 my-lg-0">
            @if (Auth::guest())
                <a href="{{ route('login') }}">Login</a>&emsp;|&emsp;
                <a href="{{ route('register') }}">Register</a>
            @else
                <a href="{{url('/home')}}" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
            @endif
        </form>
    </div>
</nav>
<div class="container-fluid">
    @yield('content')
</div>
<!-- scripts go here -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@yield('footer')
</body>
</html>