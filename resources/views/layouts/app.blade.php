<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />

    <title>{{ config('app.name', __('app.task_manager')) }}</title>

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
                    aria-expanded="false" aria-label="{{ __('app.toggle_navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse mr-auto" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <nav class="my-2 my-md-0 navbar-nav mr-auto">
                        <a class="p-2 text-dark" href="{{ route('users.index') }}"><i class="mr-1 fa fa-users"></i> {{ __('app.users') }}</a>
                        <a class="p-2 text-dark" href="{{ route('tasks.index') }}"><i class="mr-1 fa fa-tasks"></i>{{ __('app.tasks') }}</a>
                    </nav>
                    @guest
                    <a class="btn btn-outline-primary" href="{{ route('login') }}">{{ __('app.login') }}</a> @if (Route::has('register'))
                    <a class="btn btn-outline-primary ml-2" href="{{ route('register') }}">{{ __('app.register') }}</a> @endif
                    @else
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            {{ Auth::user()->name }}
                            </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('account.password.edit', Auth::user()->id) }}">{{ __('app.settings') }}</a>
                            <div class="dropdown-divider"></div>

                        </div>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" data-method="post" rel="nofollow">{{ __('app.logout') }}</a>
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
                        <ul class="list-unstyled text-small">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li><a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                    {{ $properties['native'] }}
                            </a></li>
                            @endforeach
                            <li><small class="d-block mb-3 text-muted">&copy; 2019-2022</small></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md">
                        <h5>{{ __('app.features') }}</h5>
                        <ul class="list-unstyled text-small">
                            <li><a class="text-muted" href="/privacy-policy/">{{ __('app.privacy_policy') }}</a></li>
                            <li><a class="text-muted" href="/terms-of-use/">{{ __('app.terms_of_use') }}</a></li>
                            <li><a class="text-muted" href="/about/jobs/">{{ __('app.jobs') }}</a></li>
                            <li><a class="text-muted" href="/contact/">{{ __('app.contact') }}</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md">
                        <h5>{{ __('app.about') }}</h5>
                        <ul class="list-unstyled text-small">
                            <li><a class="text-muted" href="https://github.com/geozhur/project-lvl4-s411.git" title="Site source code">
                                <i class="fa fa-code fa-lg fa-fw"></i> available under the MIT license.</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md">
                        <h5>{{ __('app.resources') }}</h5>
                        <ul class="list-unstyled text-small">
                            <li><a class="text-muted" href="https://hexlet.io/">Hexlet</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
