@extends('frontend.layouts.master')

@section('content')

 <main> 
        <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel"> 
            <div class="carousel-indicators"> 
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button> 
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button> 
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button> 
            </div> 
            <div class="carousel-inner"> 
                @include('frontend/home/slider')
                <!-- <div class="carousel-item"> 
                    <img src="frontend/images/ree/img2.jpg" class="d-block w-100" alt="Slide 2">
                            <div class="container"> 
                                <div class="carousel-caption d-flex justify-content-center align-items-center flex-column top-0"> 
                                    <h1>Easy Booking, Fast Delivery</h1> 
                                    <p class="opacity-75 fst-italic">Reserve in minutes.</p> 
                                    <p><a class="btn btn-md btn-primary" href="#">Book Now</a></p> 
                                </div> 
                            </div> 
                </div>
                <div class="carousel-item"> 
                    <img src="frontend/images/ree/img3.jpg" class="d-block w-100" alt="Slide 3">
                            <div class="container"> 
                                <div class="carousel-caption d-flex justify-content-center align-items-start flex-column top-0"> 
                                    <h1>Trusted by Professionals</h1> 
                                    <p class="opacity-75 fst-italic">Reliable service for your business.</p> 
                                    <p><a class="btn btn-md btn-primary" href="#">Gallery</a></p> 
                                </div> 
                            </div> 
                </div>  -->
                        
            </div> 
                    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev"> 
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span> 
                        <span class="visually-hidden">Previous</span> 
                    </button> 
                        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next"> 
                            <span class="carousel-control-next-icon" aria-hidden="true"></span> 
                            <span class="visually-hidden">Next</span> 
                        </button> 
        </div> 
</main>

    <div class="container-fluid"> 
        <hr class="featurette-divider"> 
                <div class="row bg-gray">
                    <div class="col-md-5">
                        <img src="frontend/images/h2.jpg" class="d-flex justify-content-center align-items-center featurette-image img-fluid mx-auto my-auto rounded" height="300" width="300" alt="h2"> 
                    </div> 
                    <div class="col-md-7 p-5"> 
                        <h2 class="featurette-heading fw-normal lh-1">On-Demand Availability</h2> 
                        <p class="lead fs-4">Whether it’s early morning or late at night, our service ensures you always have access to the equipment you need — right on schedule.</p> 
                    </div> 
                     
                </div>  
        
        <hr class="featurette-divider"> 
                <div class="row bg-gray">  
                    <div class="col-md-5">
                        <img src="frontend/images/h3.jpg" class="d-flex justify-content-center align-items-center featurette-image img-fluid mx-auto my-auto rounded" height="300" width="300" alt="h2"> 
                    </div>
                    <div class="col-md-7 p-5"> 
                        <h2 class="featurette-heading fw-normal lh-1">Seamless Support & Service</h2> 
                        <p class="lead fs-4">Got a question or issue? <br>Our team is just a call away, with fast response and proactive maintenance to keep your project running.</p> 
                    </div> 
                    
                </div>  

        <hr class="featurette-divider"> 
                <div class="row bg-gray"> 
                    <div class="col-md-5">
                        <img src="frontend/images/h4.jpg" class="d-flex justify-content-center align-items-center featurette-image img-fluid mx-auto my-auto rounded" height="300" width="300" alt="h2"> 
                    </div> 
                    <div class="col-md-7 p-5"> 
                        <h2 class="featurette-heading fw-normal lh-1">Built for Every Job Site</h2> 
                        <p class="lead fs-4">Our diverse fleet handles everything from city construction to rural development.<br> Durable machines. Zero compromise.</p> 
                    </div> 
                   
                </div>  
    </div>
        <hr class="featurette-divider">
        
@endsection