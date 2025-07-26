<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Heavy Duty Hire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <script src="https://kit.fontawesome.com/3b16a2904f.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body class="bg-light">
    @include('admin.layouts.navbar')
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- Sidebar -->
            
            @include('admin.layouts.sidebar')

            <!-- Main content -->
             <div class="col-12 col-md-9 col-lg-10 p-4">
             @yield('content')
</div>

        </div>
    </div>

    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
