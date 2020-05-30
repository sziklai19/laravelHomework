<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Oktatási rendszer')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6353746bc5.js" crossorigin="anonymous"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
        
        .input-field input[type="text"]:focus+label,
        .input-field input[type="password"]:focus+label,
        .input-field input[type="email"]:focus+label,
        .input-field input[type="number"]:focus+label,
        .input-field input[type="datetime-local"]:focus+label,
        .materialize-textarea:focus+label,
        .dropdown-content a {
            color: #03a9f4 !important;
        }

        .input-field input[type="text"]:focus,
        .input-field input[type="password"]:focus,
        .input-field input[type="email"]:focus,
        .input-field input[type="number"]:focus,
        .input-field input[type="datetime-local"]:focus,
        .materialize-textarea:focus {
            border-color: #03a9f4 !important;
            box-shadow: 0 1px 0 0 #03a9f4 !important;
        }

        [type="checkbox"].filled-in:checked+span:not(.lever):after,
        [type="radio"]:checked+span:not(.lever):after {
            border: 2px solid #03a9f4;
            background-color: #03a9f4;
        }

        a.collection-item.active {
            color: white !important;
            background-color: #03a9f4 !important;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav>
            <div class="nav-wrapper light-blue">
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a href="/" class="brand-logo truncate hide-on-med-and-up show-on-medium">Oktatási rendszer</a>
                <ul class="left hide-on-med-and-down">
                    <li
                        class="{{url()->current()==route('home') ? 'active' : ''}}">
                        <a href="{{ route('home') }}"><i class="fas fa-home left"></i>Főoldal</a></li>
                    <li class="{{url()->current()==route('contact') ? 'active' : ''}}"><a
                            href="{{ route('contact') }}"><i class="fas fa-id-card left"></i>Kapcsolat</a></li>
                </ul>
                <ul class="right hide-on-med-and-down">
                    <!-- Authentication Links -->
                    @guest
                    <li class="{{url()->current()==route('login') ? 'active' : ''}}">
                        <a class="" href="{{ route('login') }}"><i class="fas fa-sign-in-alt left"></i>Bejelentkezés</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="{{url()->current()==route('register') ? 'active' : ''}}">
                        <a class="" href="{{ route('register') }}">Regisztáció</a>
                    </li>
                    @endif
                    @else
                    <li><a href='{{route('profile')}}'><i class="fas fa-user left"></i>{{Auth::user()->name }}</a></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt left"></i>Kijelentkezés
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            @auth
            <li>
                <div class="user-view">
                    <div class="background">
                        <img class="responsive-img" src="{{asset('image/image1.jpg')}}">
                    </div>
                    <a href="{{route('profile')}}"><img class="circle white"
                            src="https://cdn.clipart.email/b664af6cfe2943432a7f31d276f335f7_avatar-pic-circle-transparent-png-clipart-free-download-ywd_512-512.png"></a>
                    <a href="{{route('profile')}}">
                        <h4 class="white-text" style="text-shadow: 0px 0px 10px rgba(0, 0, 0, 1);">
                            <strong>{{ Auth::user()->name }}</strong></h4>
                    </a>
                </div>
            </li>
            @endauth
            <li><a href="/"><i class="fas fa-home left"></i>Főoldal</a></li>
            <li><a href="{{route('contact')}}"><i class="fas fa-id-card left"></i>Kapcsolat</a></li>
            <!-- Authentication Links -->
            @guest
            <li>
                <div class="divider"></div>
            </li>
            <li>
                <a class="" href="{{ route('login') }}"><i class="fas fa-sign-in-alt left"></i>Bejelentkezés</a>
            </li>
            @if (Route::has('register'))
            <li>
                <a class="" href="{{ route('register') }}">Regisztáció</a>
            </li>
            @endif
            @else
            <li>
                <div class="divider"></div>
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header">Menü<i class="fas fa-caret-down left"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                @if (Auth::user()->teacher)
                                <li><a href="{{route('teacher')}}">Tárgyaim</a></li>
                                <li><a href="{{route('new-subject')}}">Új tárgy meghirdetése</a></li>
                                @else
                                <li><a href="{{route('student')}}">Tárgyaim</a></li>
                                <li><a href="{{route('apply-subject')}}">Tárgy felvétele</a></li>
                                <li><a href="#">Feladatok listája</a></li>
                                @endif
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li>
                <div class="divider"></div>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt left"></i>Kijelentkezés
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @endguest

        </ul>

        <main>
            @auth
            <div class="row">
                <div class="col s2 l3 xl2">
                    <div class="collection card with-header hide-on-med-and-down" style="position: sticky; top: 0;">
                        <h5 class="collection-header">Menü</h5>
                        @if (Auth::user()->teacher)
                        <a class="collection-item light-blue-text {{url()->current()==route('teacher') ? 'active' : ''}}"
                            href="{{route('teacher')}}">Tárgyaim</a></li>
                        <a class="collection-item light-blue-text {{url()->current()==route('new-subject') ? 'active' : ''}}"
                            href="{{route('new-subject')}}">Új tárgy
                            meghirdetése</a></li>
                        @else
                        <a class="collection-item light-blue-text {{url()->current()==route('student') ? 'active' : ''}}"
                            href="{{route('student')}}">Tárgyaim</a></li>
                        <a class="collection-item light-blue-text {{url()->current()==route('apply-subject') ? 'active' : ''}}"
                            href="{{route('apply-subject')}}">Tárgy felvétele</a></li>
                        <a class="collection-item light-blue-text" href="#">Feladatok listája</a></li>
                        @endif
                    </div>
                </div>
                <div class="col s12 l9 xl10">
                    @yield('content')
                </div>
            </div>
            @else
            <div class="container">
                @yield('content')
            </div>
            @endauth
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);
        });
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.tooltipped');
            var instances = M.Tooltip.init(elems);
        });
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.dropdown-trigger');
            var instances = M.Dropdown.init(elems, {
                'constrainWidth': false,
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.dropdown-trigger[data-target=menu]');
            var instances = M.Dropdown.init(elems, {
                'coverTrigger': false,
                'constrainWidth': false,
                'hover': true,
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.collapsible');
            var instances = M.Collapsible.init(elems);
        });
        
    </script>
</body>

</html>