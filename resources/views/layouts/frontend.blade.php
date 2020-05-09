<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>@yield('title')</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" ></script>
        <script src="{{ asset('js/main.js') }}" ></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    </head>
    <body>

        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <div class="app-header header-shadow">
                <div class="app-header__logo">
                    <h4>Book Management</h4>
                </div>
                <div class="app-header__content">
                    <div class="app-header-left"></div>
                    <div class="app-header-right">
                        <div class="header-btn-lg pr-0">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                    </div>
                                    @auth
                                        <div class="widget-content-left  ml-3 header-user-info">
                                            <div class="widget-heading">
                                                {{Auth::user()->name}}
                                            </div>
                                        </div>
                                    @endauth
                                    <div class="widget-content-right header-user-info ml-3">
                                        @auth
                                            <button type="button" class="btn-shadow p-1 btn btn-danger btn-sm"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                Logout
                                            </button>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        @else
                                            <a class="btn-shadow p-1 btn btn-primary btn-sm" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            <a class="btn-shadow p-1 btn btn-primary btn-sm" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>        </div>
                </div>
            </div>
            <div class="app-main">
                <div class="app-main__inner">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>
