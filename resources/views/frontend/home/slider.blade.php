@foreach($sliders as $slider)
@if($slider->id == 1)
<div class="carousel-item active">
                     <img src="{{asset('storage/'.$slider->image_link)}}" class="d-block w-100" alt="Slide 1">
                    <div class="container"> 
                        <div class="carousel-caption d-flex justify-content-center align-items-end flex-column top-0"> 
                            <h1>{{$slider->heading}}</h1> 
                            <p class="opacity-75 fst-italic">{{$slider->sub_heading}}</p> 
                            <p><a class="btn btn-md btn-primary" href="route('{{$slider->more_info_link}}')">{{$slider->btn_name}}</a></p> 
                        </div> 
                    </div> 
                </div> 
@endif

@if($slider->id == 2)
<div class="carousel-item"> 
                    <img src="{{asset('storage/'.$slider->image_link)}}" class="d-block w-100" alt="Slide 2">
                            <div class="container"> 
                                <div class="carousel-caption d-flex justify-content-center align-items-center flex-column top-0"> 
                                    <h1>{{$slider->heading}}</h1> 
                                    <p class="opacity-75 fst-italic">{{$slider->sub_heading}}</p> 
                                    <p><a class="btn btn-md btn-primary" href="route('{{$slider->more_info_link}}')">{{$slider->btn_name}}</a></p> 
                                </div> 
                            </div> 
                </div>
@endif

@if($slider->id == 3)
<div class="carousel-item"> 
                    <img src="{{asset('storage/'.$slider->image_link)}}" class="d-block w-100" alt="Slide 3">
                            <div class="container"> 
                                <div class="carousel-caption d-flex justify-content-center align-items-start flex-column top-0"> 
                                    <h1>{{$slider->heading}}</h1> 
                                    <p class="opacity-75 fst-italic">{{$slider->sub_heading}}</p> 
                                    <p><a class="btn btn-md btn-primary" href="route('{{$slider->more_info_link}}')">{{$slider->btn_name}}</a></p> 
                                </div> 
                            </div> 
                </div>
@endif
@endforeach

