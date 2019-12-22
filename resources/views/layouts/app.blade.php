<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />

    <title>{{ config('app.name', 'Task Manager') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
</head>

<body class="hold-transition skin-black-light layout-top-nav">
    <div id="app" class="wrapper">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="mb-2 mr-1" src="/img/tasklogo.svg" alt="" width="24" height="24"> {{ config('app.name', 'Task Management') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <nav class="my-2 my-md-0 navbar-nav mr-auto">
                            <a class="p-2 text-dark" href="{{ route('users.index') }}"><i class="mr-1 fa fa-users"></i> {{ __('Users') }}</a>
                            <a class="p-2 text-dark" href="{{ route('tasks.index') }}"><i class="mr-1 fa fa-tasks"></i>{{ __('Tasks') }}</a>
                    </nav>
                    @guest
                    <a class="btn btn-outline-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                    <a class="btn btn-outline-primary ml-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif @else
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                                    {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('account.edit', Auth::user()->id) }}">{{ __('Settings') }}</a>
                                <div class="dropdown-divider"></div>

                            </div>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" data-method="post" rel="nofollow">{{ __('Logout') }}</a>
                        </div>
                    @endguest
                    <!-- Right Side Of Navbar -->

                </div>
            </div>
        </nav>
        @include('flash::message')
        <main class="my-5">
            <div class="container mb-3">
                @yield('content')
            </div>
        </main>
        <footer class="border-top footer fixed-bottom pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md">
                        <img class="mb-2" src="/img/tasklogo.svg" alt="" width="24" height="24">
                        <small class="d-block mb-3 text-muted">&copy; 2019-2022</small>
                    </div>
                    <div class="col-6 col-md">
                        <h5>Features</h5>
                        <ul class="list-unstyled text-small">
                            <li><a class="text-muted" href="#">Cool stuff</a></li>
                            <li><a class="text-muted" href="#">Random feature</a></li>
                            <li><a class="text-muted" href="#">Team feature</a></li>
                            <li><a class="text-muted" href="#">Stuff for developers</a></li>
                            <li><a class="text-muted" href="#">Another one</a></li>
                            <li><a class="text-muted" href="#">Last time</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md">
                        <h5>Resources</h5>
                        <ul class="list-unstyled text-small">
                            <li><a class="text-muted" href="#">Resource</a></li>
                            <li><a class="text-muted" href="#">Resource name</a></li>
                            <li><a class="text-muted" href="#">Another resource</a></li>
                            <li><a class="text-muted" href="#">Final resource</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md">
                        <h5>About</h5>
                        <ul class="list-unstyled text-small">
                            <li><a class="text-muted" href="#">Team</a></li>
                            <li><a class="text-muted" href="#">Locations</a></li>
                            <li><a class="text-muted" href="#">Privacy</a></li>
                            <li><a class="text-muted" href="#">Terms</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
