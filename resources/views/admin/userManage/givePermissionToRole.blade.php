@extends('admin.layouts.master')
@section('content')
<div class="col-12 col-md-9 col-lg-10 p-4">
    <h2>Role : {{$role->name}}</h2>
</div>

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

<div class="container">
    <div class="card-body">
    <form action="{{url('givePermissionToRole/'.$role->id)}}" method = "POST">
        @csrf 
        @method('PUT')
        <label for="role_id">Permissions</label>
        <div class="row">
            @foreach ($permissions as $permission)
            <div class="col-md-3">
                <div class="form-check">
                    <input type="checkbox" {{in_array($permission->id, $rolePermissions)? 'checked' : ''}} class="form-check-input" name="permissions[]" value="{{$permission->name}}" id="defaultCheck1">
                    <label for="defaultCheck1" class="form-check-label">
                        {{$permission->name}}
                    </label>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
    </form>
</div>
</div>


@endsection