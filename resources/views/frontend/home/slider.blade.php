@foreach($sliders as $slider)
<div class="carousel-item active">
                     <img src="{{asset('storage/'.$slider->image_link)}}" class="d-block w-100" alt="Slide 1">
                    <div class="container"> 
                        <div class="carousel-caption d-flex justify-content-center align-items-end flex-column top-0"> 
                            <h1>{{$slider->heading}}</h1> 
                            <p class="opacity-75 fst-italic">{{$slider->sub_heading}}</p> 
                            <p><a class="btn btn-md btn-primary" href="register">Sign up today</a></p> 
                        </div> 
                    </div> 
                </div> 
@endforeach