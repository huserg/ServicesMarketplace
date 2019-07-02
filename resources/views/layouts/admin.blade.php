<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body>


<div class="container-fluid">

    <aside class="bg-dark text-white collapse" id="leftMenuBar">
        <div class="nav flex-column">
            <a class="nav-link active" href="{{ route('provider.menu') }}">Dashboard</a>
            <a class="nav-link" href="{{ route('provider.sellable') }}">Services</a>
            <a class="nav-link" href="{{ route('provider.settings') }}">Settings</a>
        </div>
    </aside>

    <header class="row navbar navbar-dark navbar-expand-md bg-dark" id="headerMenu">
        <div class="col-2">
            <button class="navbar-toggler d-inline" type="button" data-toggle="collapse"
                    data-target="#leftMenuBar" aria-controls="leftMenuBar"
                    aria-expanded="false" aria-label="Toggle navigation" onclick="toggleNav();">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="col-2">
            <a class="navbar-brand" href="{{ route('provider.menu') }}">
                {{ config('app.name', 'Laravel') }} Dashboard
            </a>
        </div>
        <div class="col-2 offset-6">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if ( auth()->user()->hasAnyRole(config('auth.ServiceProviderAuth')))
                                <a class="dropdown-item" href="{{ route('provider.menu') }}">Management</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </header>

</div>



<main id="content-p">
    <div class="container-fluid">
        @yield('content')
    </div>
</main>
</body>
</html>