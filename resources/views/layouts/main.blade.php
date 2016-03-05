<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>Laravel doctine examle</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/footer.css')}}" rel="stylesheet">
</head>

<body>

<!-- Fixed navbar -->
<div class="pos-f-t">
    <div class="collapse" id="navbar-header">
        <div class="container bg-inverse p-a-1">
            <h3>Collapsed content</h3>
            <p>Toggleable via the navbar brand.</p>
        </div>
    </div>
    <nav class="navbar navbar-light navbar-static-top bg-faded">
        <div class="container">
            <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse"
                    data-target="#exCollapsingNavbar2">
                &#9776;
            </button>
            <div class="collapse navbar-toggleable-xs" id="exCollapsingNavbar2">
                <a class="navbar-brand" href="/">Laravel doctrine example</a>
                <ul class="nav navbar-nav">
                    @if(Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard.index')}}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('logout')}}">Logout</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('auth.login')}}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('auth.register')}}">Sign up</a>
                        </li>
                    @endif
                </ul>

                <form class="form-inline pull-xs-right">
                    <input class="form-control" type="text" placeholder="Search">
                    <button class="btn btn-success-outline" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</div>

@yield('content')

<footer class="footer">
    <div class="container">
        <span class="text-muted">Place sticky footer content here.</span>
    </div>
</footer>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{asset("components/jquery/dist/jquery.min.js")}}"></script>
<script src="{{asset("components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
</body>
</html>
