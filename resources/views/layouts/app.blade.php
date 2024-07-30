<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Engineering Tour MOB FT 2024</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/asset_mob24/logo.png')}}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Bootstrap Select --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <style type="text/css">
        @import url('https://fonts.cdnfonts.com/css/04b30');
        @import url('https://fonts.cdnfonts.com/css/broken-console');
        @import url('https://fonts.cdnfonts.com/css/montserrat');
        @import url('https://fonts.cdnfonts.com/css/sancreek');
        @import url('https://fonts.cdnfonts.com/css/bricolage-grotesque');


        /* font-family: '04b', sans-serif; */
        /* font-family: 'Broken Console', sans-serif; */
        * {
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background: #390203;
        }

        .title {
            font-family: 'Sancreek', sans-serif;
            text-align: center;
            /* color: #57c1e5; */
            color: #40128b;
            font-size: 36px;
            margin-bottom: 8px;
        }

        #btn-logout{
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 2;
        }
    </style>
    
    @yield('css')

    {{-- Ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        @if(Auth::check())
            <button class="nes-btn is-error" id="btn-logout" href="{{ route('logout') }}"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</button>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @endif

        <main class="py-5">
            @yield('content')
            @yield('script')
        </main>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

</html>
