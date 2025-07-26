@extends('admin.layouts.master')
@section('content')

<div class="col-12 col-md-9 col-lg-10 p-4">
    <h2>Role</h2>
</div>
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add New Role
</button>

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
    
<!-- modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Role</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/saveRole" method="POST" enctype="multipart/form-data">

        @csrf
            <div class="modal-body">
                <!--heading-->
                <div class="mb-3">
                    <label for="role_name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Enter Role Name">
                </div>
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Role</button>
            </div>
      </form>
      
    </div>
  </div>
</div>
<!--end modal -->

<div class="mt-5">
                    <h4>Roles</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                            <tr>
                               
                                <th>ID</th>
                                <th>Role Name</th>
                               
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                @foreach($roles as $role)
                  <tr>
                      <td>{{$role->id}}</td>
                      <td>{{$role->name}}</td>
            
                      <!-- <td><img width="100" src="{{ asset('storage/' . $role->image) }}" alt="" /></td> -->
                      <td>
                         <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#slideModal{{$role->id}}">Edit</button> 
                         <a href="/permissionToRole/{{$role->id}}" class="btn btn-success">Add Permission to Role</a> 
                         <a href="/deleteRole/{{$role->id}}" class="btn btn-danger">Delete</a>
                          
                        </td>
                  </tr>


                  <div class="modal fade" id="slideModal{{$role->id}}" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="slideModalLabel">Edit Role {{$role->name}}</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="/updateRole" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="role_id" value="{{$role->id}}">
                          <div class="modal-body">
                            <!-- name -->
                                <div class="mb-3">
                                    <label for="role_name" class="form-label">title</label>
                                    <input type="text" class="form-control" id="role_name" name="role_name" value="{{$role->name}}">
                                </div>
                                

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  @endforeach
                
                 
              </tbody>
          </table>
      </div>
    </div>
</div>




@endsection
