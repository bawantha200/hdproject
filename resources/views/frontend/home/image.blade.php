@foreach($galleries as $gallery)
<div class="col-md-4">
        <div class="card shadow-sm h-100">
          <img src="{{asset('storage/'.$gallery->image_link)}}" class="card-img-top" alt="Excavator at work" data-bs-toggle="modal" data-bs-target="#modal1">
          <div class="card-body">
            <h5 class="card-title">{{$gallery->title}}</h5>
            <p class="card-text">{{$gallery->description}}</p>
          </div>
        </div>
      </div>
@endforeach