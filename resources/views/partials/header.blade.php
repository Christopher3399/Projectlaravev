<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand" href="{{ url('/') }}">
            Nouvelles Saveurs
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts.index') }}" style="color: black">Alle Posts</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.create') }}" style="color: black">New Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile.index') }}" style="color: black">Mijn Profiel</a>
                    </li>
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('faq.index') }}" style="color: black">FAQ</a>
                </li>
                @auth
                    @if (Auth::check() && Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('faq.create') }}" style="color: black">New FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link" style="color: black">All Users</a>
                        </li>
                    @endif
                @endauth
                @guest
                    <li class="nav-item">
                        <a href="{{ route('contact') }}" class="nav-link" style="color: black">Contact</a>
                    </li>

                @endguest

                <li class="nav-item">
                    @if (Auth::check() && Auth::user()->is_admin)
                        <a href="{{ route('message') }}" class="nav-link" style="color: black">Message</a>
                    @endif
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}" style="color: black">About</a>
                </li>


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
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
</nav>
