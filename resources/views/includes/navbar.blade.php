<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            Leader
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            @auth
            <!-- Authentication Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{request()->is('home')? 'active' : ''}}">
                    <a class="nav-link" href="/home">Home</a>
                </li>
                <li class="nav-item {{request()->is('products')? 'active' : ''}}">
                    <a class="nav-link" href="/products">Products</a>
                </li>
                <li class="nav-item {{request()->is('sales')? 'active' : ''}}">
                <a class="nav-link" href="/sales">Sales</a>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Hello {{ ucwords (Auth::user()->name) }}! <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{route('change-password-view')}}" class="dropdown-item">Change Password</a>
                            @if(Auth::user()->branch_id == null)
                                <div class="dropdown-divider"></div>
                                <a href="{{route('accounts')}}" class="dropdown-item">Accounts</a>
                            @endif
                            <div class="dropdown-divider"></div>
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
                </ul>
            @endauth
        </div>
    </div>
</nav>