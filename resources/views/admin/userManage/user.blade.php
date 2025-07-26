@extends('admin.layouts.master')
@section('content')
<div class="col-12 col-md-9 col-lg-10 p-4">
    <h2>Users</h2>
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

<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add New User
</button>

<!-- modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Role</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/saveUser" method="POST" enctype="multipart/form-data">

        @csrf
            <div class="modal-body">
                <!--first name-->
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
                </div>

                <!--last name-->
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
                </div>

                <!--email-->
                <div class="mb-3">
                    <label for="email" class="form-label">User E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter User E-mail">
                </div>

                <!--password-->
                <div class="mb-3">
                    <label for="password" class="form-label">User Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter User Password">
                </div>

                <!--phone-->
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone No</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone No">
                </div>

                <!--address-->
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
                </div>

                <!--roles-->
                <div class="mb-3">
                    <label for="user_password" class="form-label">User Roles</label>
                    <select class="form-control" name="roles[]">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                        <option value="{{$role}}">{{$role}}</option>
                        @endforeach
                    </select>
                </div>
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add User</button>
            </div>
      </form>
      
    </div>
  </div>
</div>
<!--end modal -->
<div class="card mb-4">
    <table id="datatablesSimple" class="table table-bordered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>User E-mail</th>
                <!-- <th>User Password</th> -->
                <th>User Roles</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->first_name}}</td>
                <td>{{$user->email}}</td>
                <!-- <td>{{$user->password}}</td> -->
                <td>
                    @foreach($user->roles as $role)
                    {{$role->name}}
                    @endforeach
                </td>
                <td>
                    <!-- <a href="/editUser/{{$user->id}}" class="btn btn-primary">Edit</a> -->
                     <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#slideModal{{$user->id}}">Edit</button> 
                    <a href="/deleteUser/{{$user->id}}" class="btn btn-danger">Delete</a>
                </td>
            </tr>

            <div class="modal fade" id="slideModal{{$user->id}}" tabindex="-1" aria-labelledby="slideModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="slideModalLabel">Edit User {{$user->name}}</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- <form method="POST" action="/updateUser" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="user_id" value="{{$user->id}}">
                          <div class="modal-body">
                            
                            <label for="email" class="form-label">E-mail</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" readonly>

                                <div class="mb-3">
                                    <label for="user_role" class="form-label">User Roles</label>
                                    <select class="form-control" name="roles[]">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                        <option value="{{$role}}">{{$role}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                          </div>
                        </form> -->
                        
                        <form method="POST" action="/updateUser">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="role" class="form-label">User Role</label>
                                    <select class="form-control" name="role" required>
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}" {{ $user->hasRole($role) ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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

@endsection