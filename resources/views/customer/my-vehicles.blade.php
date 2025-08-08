@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>My Vehicles</h1>
    
    <a href="{{ route('vehicle.index') }}" class="btn btn-secondary mb-3">
        View All Vehicles
    </a>
    
    <a href="{{ route('vehicle.store') }}" class="btn btn-success mb-3">
        Add New Vehicle
    </a>
    
    <div class="row">
        @forelse($vehicles as $vehicle)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $vehicle->brand }} {{ $vehicle->model }}</h5>
                        <p class="card-text">
                            <strong>Type:</strong> {{ $vehicle->type }}<br>
                            <strong>Status:</strong> {{ $vehicle->status }}
                        </p>
                        <div class="owner-actions">
                            <a href="{{ route('vehicle.update', $vehicle->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('vehicle.delete', $vehicle->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">You haven't added any vehicles yet.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection