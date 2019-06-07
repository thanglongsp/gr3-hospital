<nav style="position: fixed; top: 0px; background-color:#ADFF2F; width:100%;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home', ['ALL','ALL','ALL','ALL','ALL'])}}"><span
                    class="glyphicon glyphicon-home"></span> Home</a>

            <a class="navbar-brand" href="{{ route('forum') }}"><span class="glyphicon glyphicon-envelope"></span> Forum</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                @else
                <li><a href="{{ route('users.profile', Auth::user()->id) }}"><span
                            class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }}</a></li>
                <li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                @endguest
            </ul>
        </div>
    </div>
</nav> 
