<html>
<head>
    <title>Staff Awards - @yield('title')</title>
    <!-- style sheets go here -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
@include('layouts.navigation_bar')
@yield('styles')
<div class="container">
    @if(Session::has('success_message'))
        <br>
        @include('layouts.alerts')
    @endif
    @yield('content')
</div>
<!-- scripts go here -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@yield('footer')
</body>
</html>