<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sercomm Phils. Inc.</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/instascan.min.js')}}" defer></script>
    <script src="{{ asset(mix('/js/custom.js')) }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @livewireStyles
    @yield('js')
</head>
<body>
    <div id="app">
        <div id="wait">
            <div class="wait_cont">
            <img src="{{ asset('img/loading3.gif')}}" class="loading_badge"><br>LOADING...<br>Please wait.
            </div>
        </div>
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/sercomm-logo-nbg.png')}}" style='width:10rem;height:auto'>
                    {{--{{ config('app.name', 'Meal Stub') }}--}}
                    {{--MEAL ALLOWANCE--}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{--<ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('print') }}">{{ __('Print') }}</a>
                        </li>
                    </ul>--}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item">
                                <a id="testnotif" class="nav-link" style="display: none" href="#">TEST</a>
                            </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <button class="btn nav-link" style="border:none; padding-top:8px;" data-toggle="modal" data-target="#questionModal">Contact Us</button>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('FAQ') }}">{{ __('FAQ') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item">
                                <button class="btn nav-link" style="border:none; padding-top:8px;" data-toggle="modal" data-target="#questionModal">Contact Us</button>
                            </li>
                            @if(Auth::user()->role_id==2)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('ctntransact') }}">{{ __('Transactions') }}</a>
                                </li>
                            @endif
                            @if(Auth::user()->role_id==3)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('usrtransact') }}">{{ __('Transactions') }}</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('FAQ') }}">{{ __('FAQ') }}</a>
                            </li>
                            @if(Auth::user()->role_id==1 && Auth::user()->uname==env('ADMIN_USERNAME', null))
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Admin <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="nav-link" href="{{ url('/admin/report') }}">{{ __('Report Settings') }}</a>
                                </div>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('change-password') }}">{{ __('Change Password') }}

                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sign Out') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('includes.modal.contactUsModal')
    @include('includes.footer')
    @livewireScripts
    @stack('scripts')
</body>
</html>
