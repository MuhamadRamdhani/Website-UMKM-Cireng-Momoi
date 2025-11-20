 <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{route('welcome')}}"> <img src="{{url('assets/img/project/logo.jpeg')}}" alt="logo" width="50"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="menu_icon"><i class="fas fa-bars"></i></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('welcome')}}">Home</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{route('welcome')}}">Product</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('welcome')}}">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="hearer_icon d-flex">
                             <div class="dropdown cart">
                                   @auth
                                        <!-- Tampilan ketika user sudah login -->
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" id="userDropdown" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                                    Welcome, {{ Auth::user()->name }}
                                                </span>
                                                <i class="fas fa-user-circle fa-lg"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                                aria-labelledby="userDropdown">
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                        Logout
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Tampilan ketika user belum login -->
                                        <a href="{{ route('login') }}" class="btn btn-primary mr-2">Login</a>
                                        <a href="{{ route('register') }}" class="btn btn-warning">Register</a>
                                    @endauth
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>