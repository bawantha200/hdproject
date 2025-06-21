@extends('admin.layouts.master')
@section('content')
                
                <h2>Dashboard Overview</h2>
                <div class="row g-4 mt-3">
                    <div class="col-12 col-md-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <h5 class="card-title">Total Bookings</h5>
                                <p class="card-text fs-3">128</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title">Available Vehicles</h5>
                                <p class="card-text fs-3">35</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <h5 class="card-title">Pending Approvals</h5>
                                <p class="card-text fs-3">6</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <h4>Recent Bookings</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                            <tr>
                                <th>Booking ID</th>
                                <th>User</th>
                                <th>Vehicle</th>
                                <th>Status</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>#B00123</td>
                                <td>Rohan Sampath</td>
                                <td>CAT Bulldozer D6</td>
                                <td><span class="badge bg-success">Confirmed</span></td>
                                <td>LKR 120,000</td>
                            </tr>
                            <tr>
                                <td>#B00124</td>
                                <td>Sam Fernandp</td>
                                <td>Hyundai Excavator</td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                                <td>LKR 95,000</td>
                            </tr>
                            <!-- Add more booking rows here -->
                            </tbody>
                        </table>
                    </div>
                </div>
        
@endsection