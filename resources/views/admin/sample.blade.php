@extends('admin.layouts.master')
@section('content')
<div class="col-12 col-md-9 col-lg-10 p-4">
    <h2>Slider</h2>
</div>

@endsection


@if (session('success'))
    <div class="alert alert-success alet-dismissible fade show" role="alert">
        {{session('success')}}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>
                {{$error}}
            </li>
            @endforeach
        </ul>
    </div>
@endif