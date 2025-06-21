<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' | ' : '' }}{{ config('app.name', 'laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/styles.css')}}">
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/3b16a2904f.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5"> 
            <div class="container-fluid flex-column text-center"> 
                <a class="navbar-brand mx-auto mb-2" href="/"><img src="frontend/images/logo.jpg" width="80" height="80" class="d-block mx-auto rounded-circle" alt="Logo"></a> 
                <h2 class="text-white mb-3">Heavy Duty Hire</h2>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> 
                    <span class="navbar-toggler-icon"></span> 
                </button> 
                <div class="collapse navbar-collapse" id="navbarCollapse"> 
                    <ul class="navbar-nav me-auto mb-2 mb-md-0"> 
                        <li class="nav-item"> <a class="nav-link" href="/">Home</a> </li> 
                        <li class="nav-item"> <a class="nav-link" href="/vehicle">Vehicles</a> </li>
                        <li class="nav-item"><a class="nav-link" href="/gallery">Gallery</a></li> 
                        <li class="nav-item"> <a class="nav-link" href="/about">About</a> </li> 
                        <li class="nav-item"> <a class="nav-link" href="/contact">Contact Us</a> </li>
                    </ul> 
                </div> 
            </div> 
    </nav>


    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-5 shadow p-4 mt-3 mb-3 bg-white rounded">
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white pt-5 pb-4">
        <div class="container">
            <div class="row g-4 mb-4">
                <!-- Copyright and social icons -->
                <div class="col-md-6 d-flex align-items-center">
                    <p class="mb-0">© {{ date('Y') }} Heavy Duty Hire. All rights reserved.</p>
                </div>
                
                <div class="col-md-6">
                    <ul class="list-unstyled d-flex justify-content-md-end gap-3 mb-0">
                        <li>
                            <a href="#" class="link-light text-decoration-none fs-4" aria-label="Instagram">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-light text-decoration-none fs-4" aria-label="Facebook">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-light text-decoration-none fs-4" aria-label="YouTube">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-light text-decoration-none fs-4" aria-label="Twitter">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-top border-secondary pt-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <!-- Quick links -->
                    <div class="d-flex flex-wrap gap-3 mb-3 mb-md-0">
                        <a href="/" class="link-secondary text-decoration-none">Home</a>
                        <a href="/about" class="link-secondary text-decoration-none">About</a>
                        <a href="/vehicles" class="link-secondary text-decoration-none">Services</a>
                        <a href="/contact" class="link-secondary text-decoration-none">Contact</a>
                        <a href="#" class="link-secondary text-decoration-none">Privacy Policy</a>
                    </div>
                    
                    <!-- Back to top with fa-circle-arrow-up -->
                    <a href="#" class="link-gray text-decoration-none fs-2" aria-label="Back to top">
                        <i class="fa-solid fa-circle-arrow-up"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>