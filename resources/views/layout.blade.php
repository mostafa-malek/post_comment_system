<!DOCTYPE html>
<html>
<title>page title</title>
<link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Hawk') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/posts') }}">
                    Posts
                </a>
                <a class="navbar-brand" href="{{ url('/tags') }}">
                    Tags
                </a>
                <a class="navbar-brand" href="{{ url('/users') }}">
                    Users
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="dropdown">
                                <a class="dropbtn">{{ Auth::user()->name }} 
                                    <i class="fa fa-caret-down"></i>
                                  </a>
                                  <div class="dropdown-content">
                                    <a href="{{route('profile')}}">Profile</a>
                                    <form  action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-content" type="submit">Logout</button>
                                    </form>
                                  </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content');
        </main>
    </div>        
    <script src="{{url('js/bootstrap.js')}}"></script>
    <script src="{{url('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{url('js/popper.min.js')}}"></script>

</body>

</html>