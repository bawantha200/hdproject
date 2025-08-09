<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-0"> 
        <div class="container-fluid"> 
            <!-- Brand and toggle button -->
            <a class="navbar-brand" href="/">
                <img src="frontend/images/logo.jpg" width="50" height="50" class="d-inline-block align-center" alt="">
                Hevy Duty Hire
            </a> 
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> 
                <span class="navbar-toggler-icon"></span> 
            </button> 
            
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarCollapse"> 
                <ul class="navbar-nav me-auto mb-2 mb-md-0"> 
                    <li class="nav-item"> <a class="nav-link active" aria-current="page" href="/">Home</a> </li> 
                    <li class="nav-item"> <a class="nav-link" href="vehicle">Vehicles</a> </li> 
                    <li class="nav-item"><a class="nav-link" href="gallery">Gallery</a></li>
                    <li class="nav-item"> <a class="nav-link" href="about">About</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="contact">Contact Us</a> </li>
                </ul> 
                
                <!-- Search form -->
                <form class="d-flex me-3" role="search"> 
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> 
                    <button class="btn btn-outline-success" type="submit">Search</button> 
                </form> 
            </div> 
            
            <!-- User section - moved outside navbar-collapse -->
            <div class="d-flex align-items-center gap-3 ms-auto">
                @auth

                    <!-- Cart Icon with Badge -->
                    <div class="position-relative">
                        <a href="{{route('cart.index')}}" class="text-white fs-5">
                            <i class="bi bi-cart"></i>
                            @if(Cart::instance('cart')->content()->count()>0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary" style="font-size: 0.5rem;">
                                {{Cart::instance('cart')->content()->count()}}
                                <!-- <span class="visually-hidden">items in cart</span> -->
                            </span>
                            @endif
                        </a>
                    </div>

                    <!-- Profile Dropdown -->
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-white" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4 me-2"></i>
                            <span class="d-none d-md-inline">{{ Auth::user()->first_name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="dropdownUser" style="min-width: 220px;">
                            <li>
                                <div class="dropdown-header px-3 py-2">
                                    <div class="fw-500">{{ Auth::user()->full_name ?? Auth::user()->first_name }}</div>
                                    <div class="small text-muted">{{ Auth::user()->email }}</div>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center px-3 py-2" href="{{ route('dashboard') }}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center px-3 py-2" href="/profileIndex">
                                    <i class="bi bi-person me-2"></i> My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center px-3 py-2" href="">
                                    <i class="bi bi-bag me-2"></i> My Orders
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center px-3 py-2 text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Sign Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Guest View -->
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
                @endauth
            </div>
        </div> 
    </nav>    
</header>