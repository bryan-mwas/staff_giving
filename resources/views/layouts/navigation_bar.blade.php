<nav class="navbar navbar-toggleable-md navbar-inverse bg-primary">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Strathmore University</a>

    <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav mr-auto mt-2 mt-md-0"></ul>
        <ul class="navbar-nav pull-1">
            <!-- Authentication Links -->
            @if (Auth::guest())
                <li class="nav-item"><a class="text-white" href="{{ route('login') }}">Login</a></li>&nbsp;&nbsp;
                <li class="nav-item"><a class="text-white" href="{{ route('register') }}">Register</a></li>
            @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color: #f7f7f9;" href="#" id="navbarDropdownMenuLink"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"
                         style="min-width: 0rem !important;">
                        <a href="{{ route('logout') }}" class="dropdown-item"
                           onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>