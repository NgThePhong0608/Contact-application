<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title', 'Contact App')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet">
    @stack('styles')
</head>
<body>
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand text-uppercase" href="{{route('admin.contacts.index')}}">
            <strong>Contact</strong> App
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-toggler"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- /.navbar-header -->
        <div class="collapse navbar-collapse" id="navbar-toggler">
            <ul class="navbar-nav">
                @if(Auth::check())
                    <li class="nav-item @if(request()->routeIs('admin.companies*')) active @endif">
                        <a href="{{ route('admin.companies.index') }}" class="nav-link">Companies</a>
                    </li>
                    <li class="nav-item @if(request()->routeIs('admin.contacts*')) active @endif">
                        <a href="{{ route('admin.contacts.index') }}" class="nav-link">Contacts</a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav ml-auto">
                @if(!Auth::check())
                    <li class="nav-item"><a href="{{ route('login') }}" class="btn btn-outline-secondary">Login</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{route('user-profile-information.edit')}}">Settings</a>
                            <form action="{{route('logout')}}" method="POST" style="display: inline;">
                                @csrf
                                <button class="dropdown-item">Logout</button>
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
@stack('scripts')
</body>
</html>
