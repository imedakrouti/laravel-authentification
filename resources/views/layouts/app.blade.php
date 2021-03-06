<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toaster.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->hasPicture())
                                 <img src="{{asset('storage/'.Auth::user()->getPicture())}}"style="width:60px;height:50px;border-radius:50%"</img> <span class="caret"></span>
                                 @else
                                 <img src="{{ Auth::user()->getGravatar()}}"style="width:60px;height:50px;border-radius:50%"</img> <span class="caret"></span>
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('users.profile',Auth::user()->id) }}"style="border-bottom:1px solid black">
                                        Profile
                                    </a>
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
            </div>
        </nav>
@auth
            <div class="container">
                <div class="row py-4">
                    <div class="col-md-4">
                     <ul class="list-group">
                         @if(auth()->user()->isAdmin())
                            <li class="list-group-item "><a href="{{route('users.index')}}">Users</a></li>
                            @endif
                            <li class="list-group-item ">
                            <a href="{{route('categories.index')}}">Categories</a></li>
                            <li class="list-group-item nav-item dropdown"><a href="{{route('posts.index')}}" >Posts</a></li>
                            <li class="list-group-item "><a href="{{route('trushed.index')}}" >Trushed-Posts</a></li>
                            <li class="list-group-item "><a href="{{route('tags.index')}}" >Tags</a></li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                    <main class="">
                        @yield('content')
                 </main>
                </div>

                    </div>
            </div>
            @else
            <main class="py-4">
                @yield('content')
         </main>
    </div>


    @endauth
    @include('sweetalert::alert')

 <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="{{ asset('js/toaster.js') }}" ></script>
    <script>
        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}")
        @endif

        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
</script>

@yield('scripts')

</body>
</html>
