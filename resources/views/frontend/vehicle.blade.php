@extends('frontend.layouts.master')
@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <!-- Filter Sidebar -->
        <div class="col-md-3">
            <div class="card shadow-sm" style="top: 20px;">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Filter Vehicles</h5>
                </div>
                <div class="card-body">
                    <form id="filterForm" method="GET" action="{{ route('vehicle.home') }}">
                        <!-- Search Option -->
                        <div class="mb-4">
                            <label for="search" class="form-label">Search Vehicles</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="search" name="search" 
                                    placeholder="Search by name, brand or model..." 
                                    value="{{ request('search') }}">
                                <button class="btn btn-outline-dark" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-4">
                            <label class="form-label">Price Range</label>
                            <div class="d-flex justify-content-between mb-2">
                                <span>LKR 0</span>
                                <span>LKR 10000+</span>
                            </div>
                            <input type="range" class="form-range" id="priceRange" min="0" max="100000" 
                                   oninput="updatePriceValues(this.value)" 
                                   value="{{ request('max_price', 100000) }}">
                            <div class="d-flex justify-content-between mt-2">
                                <span id="minPrice">LKR 0</span>
                                <input type="hidden" id="minPriceInput" name="min_price" value="{{ request('min_price', 0) }}">
                                <span id="maxPrice">LKR {{ request('max_price', 100000) }}</span>
                                <input type="hidden" id="maxPriceInput" name="max_price" value="{{ request('max_price', 100000) }}">
                            </div>
                        </div>
                        
                        <!-- Vehicle Categories -->
                        <div class="mb-4">
                            <label class="form-label">Vehicle Categories</label>
                            @foreach($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="categories[]" id="category_{{ $category->id }}" 
                                       value="{{ $category->id }}"
                                       {{ in_array($category->id, (array)request('categories', [])) ? 'checked' : '' }} 
                                       onchange="this.form.submit()">
                                <label class="form-check-label" for="category_{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <!-- Availability -->
                        <div class="mb-4">
                            <label class="form-label">Availability</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="availability" 
                                    id="available" value="available" 
                                    {{ request('availability', 'available') == 'available' ? 'checked' : '' }} onchange="this.form.submit()">
                                <label class="form-check-label" for="available">Available</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="availability" 
                                    id="rented" value="rented" 
                                    {{ request('availability') == 'rented' ? 'checked' : '' }} onchange="this.form.submit()">
                                <label class="form-check-label" for="rented">Rented</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="availability" 
                                    id="all" value="all" 
                                    {{ request('availability') == 'all' ? 'checked' : '' }} onchange="this.form.submit()">
                                <label class="form-check-label" for="all">Show All</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100">
                            <i class="fas fa-filter"></i> Apply Filters
                        </button>
                        <a href="{{ route('vehicle.home') }}" class="btn btn-outline-secondary w-100 mt-2">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Vehicle Listing -->
        <div class="col-md-9">
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="h4">Showing {{ $vehicles->total() }} Vehicles</h2>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button class="btn btn-outline-secondary active">
                                <i class="fas fa-th"></i> Grid
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-list"></i> List
                            </button>
                        </div>
                        <div>
                            <span class="me-2">Sort:</span>
                            <select class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()" name="sort" form="filterForm">
                                <option value="">Default</option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @include('frontend.home.vehicle')
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12">
                    {{ $vehicles->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize price range values
    document.addEventListener('DOMContentLoaded', function() {
        const maxPrice = {{ request('max_price', 1000) }};
        document.getElementById('priceRange').value = maxPrice;
        updatePriceValues(maxPrice);
    });

    function updatePriceValues(value) {
        document.getElementById('maxPrice').textContent = 'LKR ' + value;
        document.getElementById('maxPriceInput').value = value;
    }
</script>
@endsection