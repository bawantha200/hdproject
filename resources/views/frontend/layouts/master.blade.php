<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H D H</title>
    <link rel="stylesheet" href="{{asset('frontend/css/styles.css')}}">
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-gray">
    
    @include('frontend/layouts.navbar')
    
    <div>
        @yield('content')
    </div>
   
    @include('frontend.layouts.footer')



</body>
<script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://kit.fontawesome.com/3b16a2904f.js" crossorigin="anonymous"></script>
</html>