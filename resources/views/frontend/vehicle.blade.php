<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Heavy Vehicle Catalog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #2c3e50;
      --secondary-color: #3498db;
      --accent-color: #e74c3c;
      --light-bg: #f8f9fa;
      --dark-bg: #343a40;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .navbar-brand {
      font-weight: 700;
    }
    
    .filter-card {
      position: sticky;
      top: 20px;
      border: none;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .filter-header {
      background: var(--primary-color);
      padding: 15px;
    }
    
    .filter-section {
      border-bottom: 1px solid #eee;
      padding: 15px;
    }
    
    .filter-section:last-child {
      border-bottom: none;
    }
    
    .filter-title {
      font-size: 1rem;
      font-weight: 600;
      margin-bottom: 12px;
      color: var(--primary-color);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .filter-title:hover {
      cursor: pointer;
    }
    
    .filter-title::after {
      content: '\f078';
      font-family: 'Font Awesome 6 Free';
      font-weight: 900;
      font-size: 0.8rem;
      transition: transform 0.3s;
    }
    
    .filter-title.collapsed::after {
      transform: rotate(-90deg);
    }
    
    .vehicle-card {
      transition: all 0.3s ease;
      border: none;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      height: 100%;
    }
    
    .vehicle-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .vehicle-img {
      height: 180px;
      object-fit: cover;
      width: 100%;
    }
    
    .vehicle-title {
      font-weight: 600;
      color: var(--primary-color);
      margin-bottom: 0.5rem;
    }
    
    .vehicle-price {
      font-weight: 700;
      color: var(--accent-color);
      font-size: 1.1rem;
    }
    
    .badge-availability {
      padding: 5px 10px;
      border-radius: 20px;
      font-weight: 500;
    }
    
    .section-title {
      position: relative;
      padding-bottom: 10px;
      margin-bottom: 25px;
      color: var(--primary-color);
    }
    
    .section-title::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      width: 60px;
      height: 3px;
      background: var(--secondary-color);
    }
    
    .no-results {
      display: none;
      text-align: center;
      padding: 50px 0;
    }
    
    .no-results i {
      font-size: 3rem;
      color: #ccc;
      margin-bottom: 20px;
    }
    
    footer {
      background: var(--dark-bg);
    }
    
    .back-to-top {
      transition: all 0.3s;
    }
    
    .back-to-top:hover {
      color: var(--secondary-color) !important;
      transform: translateY(-3px);
    }
    
    @media (max-width: 991.98px) {
      .filter-card {
        position: static;
        margin-bottom: 30px;
      }
    }
  </style>
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-0"> 
            <div class="container-fluid"> 
                <a class="navbar-brand" href="/">
                    <img src="frontend/images/logo.jpg" width="50" height="50" class="d-inline-block align-center" alt="">
                    Hevy Duty Hire</a> 
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> 
                    <span class="navbar-toggler-icon"></span> 
                </button> 
                <div class="collapse navbar-collapse" id="navbarCollapse"> 
                    <ul class="navbar-nav me-auto mb-2 mb-md-0"> 
                        <li class="nav-item"> <a class="nav-link active" aria-current="page" href="/">Home</a> </li> 
                        <li class="nav-item"> <a class="nav-link" href="vehicle">Vehicles</a> </li> 
                        
                         
                        <!-- dropdown -->
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                            <ul class="dropdown-menu">
                                        <!-- Earthmoving Equipment -->
                                        <li><h6 class="dropdown-header">Earthmoving Equipment</h6></li>
                                        <li><a class="dropdown-item" href="#">Excavator</a></li>
                                        <li><a class="dropdown-item" href="#">Bulldozer</a></li>
                                        <li><a class="dropdown-item" href="#">Backhoe Loader</a></li>
                                        <!-- Material Handling -->
                                        <hr class="dropdown-divider"></li>
                                        <li><h6 class="dropdown-header">Material Handling</h6></li>
                                        <li><a class="dropdown-item" href="#">Forklift</a></li>
                                        <li><a class="dropdown-item" href="#">Crane Truck</a></li>
                                        <!-- Hauling & Transport -->
                                         <hr class="dropdown-divider"></li>
                                        <li><h6 class="dropdown-header">Hauling & Transport</h6></li>
                                        <li><a class="dropdown-item" href="#">Tipper Truck</a></li>
                                        <li><a class="dropdown-item" href="#">Flatbed Truck</a></li>
                                        <!-- Concrete Equipment -->
                                         <hr class="dropdown-divider"></li>
                                        <li><h6 class="dropdown-header">Concrete Equipment</h6></li>
                                        <li><a class="dropdown-item" href="#">Concrete Mixer</a></li>
                                        <li><a class="dropdown-item" href="#">Concrete Pump</a></li>
                                        <!-- Road Construction -->
                                         <hr class="dropdown-divider"></li>
                                        <li><h6 class="dropdown-header">Road Construction</h6></li>
                                        <li><a class="dropdown-item" href="#">Road Roller</a></li>
                                        <li><a class="dropdown-item" href="#">Asphalt Paver</a></li>
                            </ul>
                        </li>
                        <!-- dropdown-end -->
                        <li class="nav-item"><a class="nav-link" href="gallery">Gallery</a></li>
                        <li class="nav-item"> <a class="nav-link" href="about">About</a> </li>
                        <li class="nav-item"> <a class="nav-link" href="contact">Contact Us</a> </li>

                    </ul> 
                    <form class="d-flex mb-2" role="search"> 
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> 
                        <button class="btn btn-outline-success" type="submit">Search</button> 
                    </form> 
                    <div class="col-md-3 text-end">
                        <a href="dashboard"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
                        <a href="register"> <button type="button" class="btn btn-primary">Sign-up</button></a>
                    </div>
                </div> 
            </div> 
    </nav>    
</header>
    
  <div class="container my-5">
    <div class="row">
      <!-- Filter Sidebar -->
      <div class="col-lg-3 mb-4 overflow-hidden">
        <div class="card filter-card">
          <div class="filter-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Vehicles</h5>
          </div>
          <div class="card-body p-0">
            <!-- Search Filter -->
            <div class="filter-section">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" id="searchFilter" placeholder="Search vehicles...">
              </div>
            </div>
            
            <!-- Price Range Filter -->
            <div class="filter-section">
              <div class="filter-title" data-bs-toggle="collapse" href="#priceCollapse">
                Price Range
              </div>
              <div class="collapse show" id="priceCollapse">
                <div class="d-flex justify-content-between mb-2 small text-muted">
                  <span>$100</span>
                  <span>$10,000+</span>
                </div>
                <input type="range" class="form-range mb-3" min="100" max="10000" step="100" id="priceRange">
                <div class="row g-2">
                  <div class="col">
                    <label class="form-label small text-muted">Min</label>
                    <input type="number" class="form-control form-control-sm" placeholder="$100" id="minPrice" min="100" max="10000">
                  </div>
                  <div class="col">
                    <label class="form-label small text-muted">Max</label>
                    <input type="number" class="form-control form-control-sm" placeholder="$10,000" id="maxPrice" min="100" max="10000">
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Vehicle Type Filter -->
            <div class="filter-section">
              <div class="filter-title collapsed" data-bs-toggle="collapse" href="#typeCollapse">
                Vehicle Type
              </div>
              <div class="collapse" id="typeCollapse">
                <div class="form-check mb-2">
                  <input class="form-check-input filter-checkbox" type="checkbox" value="Excavator" id="excavatorCheck" checked>
                  <label class="form-check-label" for="excavatorCheck">
                    Excavators
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input filter-checkbox" type="checkbox" value="Bulldozer" id="bulldozerCheck" checked>
                  <label class="form-check-label" for="bulldozerCheck">
                    Bulldozers
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input filter-checkbox" type="checkbox" value="Loader" id="loaderCheck" checked>
                  <label class="form-check-label" for="loaderCheck">
                    Loaders
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input filter-checkbox" type="checkbox" value="Crane" id="craneCheck" checked>
                  <label class="form-check-label" for="craneCheck">
                    Cranes
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input filter-checkbox" type="checkbox" value="Truck" id="truckCheck" checked>
                  <label class="form-check-label" for="truckCheck">
                    Trucks
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input filter-checkbox" type="checkbox" value="Forklift" id="forkliftCheck" checked>
                  <label class="form-check-label" for="forkliftCheck">
                    Forklifts
                  </label>
                </div>
              </div>
            </div>
            
            <!-- Brand Filter -->
            <div class="filter-section">
              <div class="filter-title collapsed" data-bs-toggle="collapse" href="#brandCollapse">
                Brand
              </div>
              <div class="collapse" id="brandCollapse">
                <div class="form-check mb-2">
                  <input class="form-check-input brand-checkbox" type="checkbox" value="Caterpillar" id="caterpillarCheck" checked>
                  <label class="form-check-label" for="caterpillarCheck">
                    Caterpillar
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input brand-checkbox" type="checkbox" value="Komatsu" id="komatsuCheck" checked>
                  <label class="form-check-label" for="komatsuCheck">
                    Komatsu
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input brand-checkbox" type="checkbox" value="Hitachi" id="hitachiCheck" checked>
                  <label class="form-check-label" for="hitachiCheck">
                    Hitachi
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input brand-checkbox" type="checkbox" value="Volvo" id="volvoCheck" checked>
                  <label class="form-check-label" for="volvoCheck">
                    Volvo
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input brand-checkbox" type="checkbox" value="JCB" id="jcbCheck" checked>
                  <label class="form-check-label" for="jcbCheck">
                    JCB
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input brand-checkbox" type="checkbox" value="Toyota" id="toyotaCheck" checked>
                  <label class="form-check-label" for="toyotaCheck">
                    Toyota
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input brand-checkbox" type="checkbox" value="Doosan" id="doosanCheck" checked>
                  <label class="form-check-label" for="doosanCheck">
                    Doosan
                  </label>
                </div>
              </div>
            </div>
            
            <!-- Availability Filter -->
            <div class="filter-section">
              <div class="filter-title" data-bs-toggle="collapse" href="#availabilityCollapse">
                Availability
              </div>
              <div class="collapse show" id="availabilityCollapse">
                <div class="form-check mb-2">
                  <input class="form-check-input availability-radio" type="radio" name="availabilityRadio" id="availableNow" value="available" checked>
                  <label class="form-check-label" for="availableNow">
                    Available Now
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input availability-radio" type="radio" name="availabilityRadio" id="availableSoon" value="soon">
                  <label class="form-check-label" for="availableSoon">
                    Available Soon
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input availability-radio" type="radio" name="availabilityRadio" id="allAvailability" value="all">
                  <label class="form-check-label" for="allAvailability">
                    Show All
                  </label>
                </div>
              </div>
            </div>
            
            <!-- Location Filter -->
            <div class="filter-section">
              <div class="filter-title" data-bs-toggle="collapse" href="#locationCollapse">
                Location
              </div>
              <div class="collapse show" id="locationCollapse">
                <select class="form-select form-select-sm" id="locationSelect">
                  <option value="all" selected>All Locations</option>
                  <option value="north">North Region</option>
                  <option value="south">South Region</option>
                  <option value="east">East Region</option>
                  <option value="west">West Region</option>
                  <option value="central">Central Region</option>
                </select>
              </div>
            </div>
            
            <div class="filter-section bg-light p-3">
              <button class="btn btn-dark  w-100 mb-2" id="applyFilters">
                <i class="fas fa-check-circle me-2"></i>Apply Filters
              </button>
              <button class="btn btn-outline-secondary w-100" id="resetFilters">
                <i class="fas fa-undo me-2"></i>Reset Filters
              </button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Main Content -->
      <div class="col-lg-9">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
          <h1 class="mb-3 mb-md-0">Heavy Duty Vehicle Catalog</h1>
          
          <div class="d-flex align-items-center">
            <!-- Results Count -->
            <div class="me-3 d-none d-md-block">
              <span class="badge bg-primary rounded-pill" id="resultsCount">42</span>
              <span class="small text-muted">vehicles found</span>
            </div>
            
            <!-- Sort Dropdown -->
            <div class="dropdown">
              <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-sort me-1"></i>Sort by: Default
              </button>
              <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                <li><a class="dropdown-item sort-option" href="#" data-sort="default">Default</a></li>
                <li><a class="dropdown-item sort-option" href="#" data-sort="price-low">Price: Low to High</a></li>
                <li><a class="dropdown-item sort-option" href="#" data-sort="price-high">Price: High to Low</a></li>
                <li><a class="dropdown-item sort-option" href="#" data-sort="newest">Newest First</a></li>
                <li><a class="dropdown-item sort-option" href="#" data-sort="popular">Most Popular</a></li>
              </ul>
            </div>
          </div>
        </div>
        
        <!-- Mobile Results Count -->
        <div class="alert alert-info mb-4 d-md-none">
          Showing <strong id="mobileResultsCount">42</strong> vehicles matching your criteria
        </div>
        
        <!-- No Results Message -->
        <div class="no-results" id="noResults">
          <i class="fas fa-truck-loading"></i>
          <h4>No vehicles match your filters</h4>
          <p class="text-muted">Try adjusting your filters or search terms</p>
          <button class="btn btn-primary" id="resetFiltersNoResults">Reset Filters</button>
        </div>

        <!-- Earthmoving Equipment -->
        <div class="my-5 vehicle-section" id="earth" data-category="earthmoving">
            <h3 class="section-title">Earthmoving Equipment</h3>
            <div class="row" id="earthmoving-vehicles">
                <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Excavator" data-brand="Caterpillar" data-price="450" data-availability="available" data-location="north">
                    <div class="card h-100 vehicle-card">
                        <div class="card-body">
                            <h5 class="vehicle-title">Caterpillar 320 GC</h5>
                            <img src="images/vehicle/caterpillar_320GC.jpeg" class="vehicle-img rounded mb-3" alt="Caterpillar 320 GC">
                            <p class="card-text small text-muted">A 20-ton hydraulic excavator ideal for digging trenches, lifting pipes, and general earthmoving on construction sites. Known for its fuel efficiency and low maintenance.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                              <span class="badge bg-success badge-availability">Available</span>
                              <span class="vehicle-price">$450/day</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Excavator" data-brand="Komatsu" data-price="520" data-availability="available" data-location="south">
                    <div class="card h-100 vehicle-card">
                        <div class="card-body">
                            <h5 class="vehicle-title">Komatsu PC210LC-11</h5>
                            <img src="images/vehicle/komatsu-pc-210-lc-11.jpg" class="vehicle-img rounded mb-3" alt="Komatsu PC210LC-11">
                            <p class="card-text small text-muted">Heavy-duty excavator with precise control and a powerful engine, perfect for excavation and loading tasks in both urban and industrial settings.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                              <span class="badge bg-success badge-availability">Available</span>
                              <span class="vehicle-price">$520/day</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Excavator" data-brand="Hitachi" data-price="480" data-availability="soon" data-location="east">
                    <div class="card h-100 vehicle-card">
                        <div class="card-body">
                            <h5 class="vehicle-title">Hitachi ZX210LC-6</h5>
                            <img src="images/vehicle/HITACHI-ZX210LC-6.jpg" class="vehicle-img rounded mb-3" alt="Hitachi ZX210LC-6">
                            <p class="card-text small text-muted">Versatile excavator combining speed, efficiency, and durability, widely used for foundation work and land clearing.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                              <span class="badge bg-warning text-dark badge-availability">Available Soon</span>
                              <span class="vehicle-price">$480/day</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Loader" data-brand="JCB" data-price="380" data-availability="available" data-location="west">
                    <div class="card h-100 vehicle-card">
                        <div class="card-body">
                            <h5 class="vehicle-title">JCB 3CX Backhoe Loader</h5>
                            <img src="https://gsat.jp/wp-content/uploads/jcb-3cx-sitemaster-4x4-backhoe-loader-div5235a-copy.webp" class="vehicle-img rounded mb-3" alt="JCB 3CX Backhoe Loader">
                            <p class="card-text small text-muted">Combines a front loader and a rear excavator, making it ideal for digging, trenching, and material handling in tight job sites.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                              <span class="badge bg-success badge-availability">Available</span>
                              <span class="vehicle-price">$380/day</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Excavator" data-brand="Volvo" data-price="550" data-availability="available" data-location="central">
                    <div class="card h-100 vehicle-card">
                        <div class="card-body">
                            <h5 class="vehicle-title">Volvo EC220DL</h5>
                            <img src="https://www.bossmachinery.nl/data/images/vehicles/01_Volvo_EC220_BM3152DSC08081.JPG" class="vehicle-img rounded mb-3" alt="Volvo EC220DL">
                            <p class="card-text small text-muted">Energy-efficient excavator known for its long boom reach and smooth hydraulics, used in large-scale digging and grading.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                              <span class="badge bg-success badge-availability">Available</span>
                              <span class="vehicle-price">$550/day</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Excavator" data-brand="Doosan" data-price="490" data-availability="available" data-location="north">
                    <div class="card h-100 vehicle-card">
                        <div class="card-body">
                            <h5 class="vehicle-title">Doosan DX225LC-5</h5>
                            <img src="https://www.bossmachinery.nl/data/images/vehicles/l_02_Doosan%20DX225LC-5%20-%20BM5136_06.JPEG" class="vehicle-img rounded mb-3" alt="Doosan DX225LC-5">
                            <p class="card-text small text-muted">Durable excavator that delivers high productivity for general excavation, demolition, and site prep work.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                              <span class="badge bg-success badge-availability">Available</span>
                              <span class="vehicle-price">$490/day</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Excavator" data-brand="Hyundai" data-price="470" data-availability="unavailable" data-location="south">
                    <div class="card h-100 vehicle-card">
                        <div class="card-body">
                            <h5 class="vehicle-title">Hyundai R220LC-9S</h5>
                            <img src="https://www.bossmachinery.nl/data/images/vehicles/01_Hyundai%20R220LC-9S%20-%20BM5613_08.jpg" class="vehicle-img rounded mb-3" alt="Hyundai R220LC-9S">
                            <p class="card-text small text-muted">Medium-sized excavator with user-friendly controls and advanced fuel-saving features, often used in public infrastructure projects.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                              <span class="badge bg-danger badge-availability">Unavailable</span>
                              <span class="vehicle-price">$470/day</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Loader" data-brand="Case" data-price="420" data-availability="available" data-location="east">
                    <div class="card h-100 vehicle-card">
                        <div class="card-body">
                            <h5 class="vehicle-title">Case 570N EP</h5>
                            <img src="https://www.rurallifestyledealer.com/ext/resources/images/webarticles/winter2015/CASE-570N-EP-Tractor-Loader.png?t=1426534020&width=696" class="vehicle-img rounded mb-3" alt="Case 570N EP">
                            <p class="card-text small text-muted">A reliable loader/backhoe with excellent lifting and digging strength, ideal for municipal and commercial use.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                              <span class="badge bg-success badge-availability">Available</span>
                              <span class="vehicle-price">$420/day</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Bulldozer" data-brand="Komatsu" data-price="680" data-availability="available" data-location="west">
                    <div class="card h-100 vehicle-card">
                        <div class="card-body">
                            <h5 class="vehicle-title">Komatsu D85EX-18 Bulldozer</h5>
                            <img src="https://www.komatsu.eu/-/media/projects/komatsu/og-image/products/prange/products_ogimage_0032_d85expx_18.ashx?rev=c930d789cb3b4c4288c3991b540496da&hash=DBCBD47E97FDD9361923D9AD43835625" class="vehicle-img rounded mb-3" alt="Komatsu D85EX-18 Bulldozer">
                            <p class="card-text small text-muted">Powerful crawler dozer with precision blade control, suitable for heavy land clearing and grading.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                              <span class="badge bg-success badge-availability">Available</span>
                              <span class="vehicle-price">$680/day</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Bulldozer" data-brand="Liebherr" data-price="720" data-availability="available" data-location="central">
                    <div class="card h-100 vehicle-card">
                        <div class="card-body">
                            <h5 class="vehicle-title">Liebherr PR 726 Litronic</h5>
                            <img src="https://power-equip.com/wp-content/uploads/2025/03/liebherr-pr726-crawler-dozer-2.jpg" class="vehicle-img rounded mb-3" alt="Liebherr PR 726 Litronic">
                            <p class="card-text small text-muted">A medium-class dozer offering smooth joystick control and robust undercarriage, great for site preparation.</p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                              <span class="badge bg-success badge-availability">Available</span>
                              <span class="vehicle-price">$720/day</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Material Handling -->
        <div class="my-5 vehicle-section" data-category="material">
          <h3 class="section-title">Material Handling</h3>
          <div class="row" id="material-vehicles">
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Forklift" data-brand="Toyota" data-price="220" data-availability="available" data-location="north">
                <div class="card h-100 vehicle-card">
                    <div class="card-body">
                        <h5 class="vehicle-title">Toyota 8FGCU25 Forklift</h5>
                        <img src="https://www.forklifttrader.com/Content/files/GenCart/ProductImages/1_v_de6a.jpeg" class="vehicle-img rounded mb-3" alt="Toyota 8FGCU25 Forklift">
                        <p class="card-text small text-muted">A reliable LPG-powered forklift with strong lifting capacity, perfect for warehouses and logistics centers.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-success badge-availability">Available</span>
                          <span class="vehicle-price">$220/day</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Forklift" data-brand="Doosan" data-price="240" data-availability="available" data-location="south">
                <div class="card h-100 vehicle-card">
                    <div class="card-body">
                        <h5 class="vehicle-title">Doosan G25P-5 Forklift</h5>
                        <img src="https://images.rouseservices.com/ImageProcessor/Get/GetImage.aspx?type=ItemDetailExpanded&guid=DDF6EA10-541C-A8F7-27A4-E32A81B4CE1D" class="vehicle-img rounded mb-3" alt="Doosan G25P-5 Forklift">
                        <p class="card-text small text-muted">Rugged and ergonomic forklift designed for indoor material handling with excellent stability and visibility.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-success badge-availability">Available</span>
                          <span class="vehicle-price">$240/day</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Forklift" data-brand="Hyster" data-price="260" data-availability="available" data-location="east">
                <div class="card h-100 vehicle-card">
                    <div class="card-body"><h5 class="vehicle-title">Hyster H50FT</h5>
                        <img src="https://forkliftexchange.com/wp-content/uploads/2025/02/Screenshot-2025-02-03-at-9.50.15%E2%80%AFAM.jpg" class="vehicle-img rounded mb-3" alt="Hyster H50FT">
                        <p class="card-text small text-muted">Industrial forklift that balances power and maneuverability, ideal for manufacturing plants.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-success badge-availability">Available</span>
                          <span class="vehicle-price">$260/day</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Forklift" data-brand="Mitsubishi" data-price="280" data-availability="soon" data-location="west">
                <div class="card h-100 vehicle-card">
                    <div class="card-body"><h5 class="vehicle-title">Mitsubishi FD50N</h5>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9whvh-3-f_YcXSDnAI6ySsrI6W067FpDWUw&s" class="vehicle-img rounded mb-3" alt="Mitsubishi FD50N">
                        <p class="card-text small text-muted">A diesel-powered heavy-duty forklift with advanced safety features, used in outdoor storage yards and ports.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-warning text-dark badge-availability">Available Soon</span>
                          <span class="vehicle-price">$280/day</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Forklift" data-brand="Crown" data-price="250" data-availability="available" data-location="central">
                <div class="card h-100 vehicle-card">
                    <div class="card-body"><h5 class="vehicle-title">Crown FC 5200</h5>
                        <img src="https://images.craigslist.org/00E0E_gJqyZXF6Ujn_0j10dq_600x450.jpg" class="vehicle-img rounded mb-3" alt="Crown FC 5200">
                        <p class="card-text small text-muted">High-performance electric forklift with tight turning radius for narrow warehouse aisles.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-success badge-availability">Available</span>
                          <span class="vehicle-price">$250/day</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Forklift" data-brand="Jungheinrich" data-price="270" data-availability="available" data-location="north">
                <div class="card h-100 vehicle-card">
                    <div class="card-body"><h5 class="vehicle-title">Jungheinrich EFG 320</h5>
                        <img src="https://cdn.truckscout24.com/data/listing/img/vga/ts/29/02/8427515-01.jpg?v=1714670871" class="vehicle-img rounded mb-3" alt="Jungheinrich EFG 320">
                        <p class="card-text small text-muted">A German-engineered electric forklift offering energy efficiency and high stacking capabilities.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-success badge-availability">Available</span>
                          <span class="vehicle-price">$270/day</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Crane" data-brand="Tadano" data-price="580" data-availability="available" data-location="south">
                <div class="card h-100 vehicle-card">
                    <div class="card-body"><h5 class="vehicle-title">Tadano TM-ZR500 Crane Truck</h5>
                        <img src="https://storage.bigge.com/webstorage/equipment/_1200x630_crop_center-center_82_none/IMG_2663_2022-06-30-001102_ddsf.jpeg?mtime=1721842437" class="vehicle-img rounded mb-3" alt="Tadano TM-ZR500 Crane Truck">
                        <p class="card-text small text-muted">Truck-mounted telescopic crane used for lifting heavy construction components on-site.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-success badge-availability">Available</span>
                          <span class="vehicle-price">$580/day</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Crane" data-brand="UNIC" data-price="320" data-availability="available" data-location="east">
                <div class="card h-100 vehicle-card">
                    <div class="card-body"><h5 class="vehicle-title">UNIC URV500 Mini Crane</h5>
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSl8fSirWx6VjK3lNtoCIIxFBUJPoL5-U8ndw&s" class="vehicle-img rounded mb-3" alt="UNIC URV500 Mini Crane">
                        <p class="card-text small text-muted">Compact mobile crane designed for lifting tasks in limited spaces, such as urban or residential areas.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-success badge-availability">Available</span>
                          <span class="vehicle-price">$320/day</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Crane" data-brand="Kobelco" data-price="650" data-availability="unavailable" data-location="west">
                <div class="card h-100 vehicle-card">
                    <div class="card-body"><h5 class="vehicle-title">Kobelco RK250-7 Crane</h5>
                        <img src="https://cdn.cranemarket.com/images/listings/kobelco-rk250-7-25-ton-rough-terrain-crane-50443.jpg" class="vehicle-img rounded mb-3" alt="Kobelco RK250-7 Crane">
                        <p class="card-text small text-muted">All-terrain crane with powerful lifting capabilities, designed for rugged, uneven job sites.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-danger badge-availability">Unavailable</span>
                          <span class="vehicle-price">$650/day</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Crane" data-brand="Liebherr" data-price="850" data-availability="available" data-location="central">
                <div class="card h-100 vehicle-card">
                    <div class="card-body"><h5 class="vehicle-title">Liebherr LTM 1055-3.2</h5>
                        <img src="https://www.northwestcraneservice.com/wp-content/uploads/2023/06/ltm-1055-3.2-northwest-concrete-068261-6-reduziert-scaled.jpg" class="vehicle-img rounded mb-3" alt="Liebherr LTM 1055-3.2">
                        <p class="card-text small text-muted">Multi-axle mobile crane offering exceptional reach and precision in lifting steel and prefab structures.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-success badge-availability">Available</span>
                          <span class="vehicle-price">$850/day</span>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>

        <!-- Hauling & Transport -->
        <div class="my-5 vehicle-section" data-category="hauling">
          <h3 class="section-title">Hauling & Transport</h3>
          <div class="row" id="hauling-vehicles">
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Truck" data-brand="Ashok Leyland" data-price="420" data-availability="available" data-location="north">
                <div class="card h-100 vehicle-card">
                    <div class="card-body">
                        <h5 class="vehicle-title">Ashok Leyland U 3718 Tipper</h5>
                        <img src="https://img.gaadibazaar.in/new-vehicle-images/1445507/conversions/555c708e-3a0a-4326-8d8c-686088e55a48-vdp.webp" class="vehicle-img rounded mb-3" alt="Ashok Leyland U 3718 Tipper">
                        <p class="card-text small text-muted">High-capacity tipper truck ideal for transporting sand, gravel, or debris in bulk across short to medium distances.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-success badge-availability">Available</span>
                          <span class="vehicle-price">$420/day</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Truck" data-brand="Tata" data-price="450" data-availability="available" data-location="south">
                <div class="card h-100 vehicle-card">
                    <div class="card-body">
                        <h5 class="vehicle-title">Tata Prima 3530.K</h5>
                        <img src="https://truckcdn.cardekho.com/in/tata/prima-fl-3530-k-bs6/tata-prima-fl-3530-k-bs6-54252.jpg" class="vehicle-img rounded mb-3" alt="Tata Prima 3530.K">
                        <p class="card-text small text-muted">A strong dumper truck with high payload capacity, built for mining, quarrying, and large-scale earthmoving.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-success badge-availability">Available</span>
                          <span class="vehicle-price">$450/day</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Truck" data-brand="Isuzu" data-price="380" data-availability="available" data-location="east">
                <div class="card h-100 vehicle-card">
                    <div class="card-body">
                        <h5 class="vehicle-title">Isuzu FVR 34K</h5>
                        <img src="https://avtozaz.uz/wp-content/uploads/2023/04/b1a56963018e085c2efe-2.jpg" class="vehicle-img rounded mb-3" alt="Isuzu FVR 34K">
                        <p class="card-text small text-muted">Medium-duty flatbed used for transporting heavy equipment, precast units, or building materials.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-success badge-availability">Available</span>
                          <span class="vehicle-price">$380/day</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Truck" data-brand="Scania" data-price="520" data-availability="available" data-location="west">
                <div class="card h-100 vehicle-card">
                    <div class="card-body">
                        <h5 class="vehicle-title">Scania G 460 XT</h5>
                        <img src="images/vehicle/caterpillar_320GC.jpeg" class="vehicle-img rounded mb-3" alt="Scania G 460 XT">
                        <p class="card-text small text-muted">A powerful on/off-road truck built for transporting oversized construction machinery and aggregates.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-success badge-availability">Available</span>
                          <span class="vehicle-price">$520/day</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Truck" data-brand="MAN" data-price="480" data-availability="soon" data-location="central">
                <div class="card h-100 vehicle-card">
                    <div class="card-body">
                        <h5 class="vehicle-title">MAN TGS 33.360</h5>
                        <img src="images/vehicle/caterpillar_320GC.jpeg" class="vehicle-img rounded mb-3" alt="MAN TGS 33.360">
                        <p class="card-text small text-muted">Long-haul truck with a high-torque engine, used for transporting concrete pipes, steel, and construction panels.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-warning text-dark badge-availability">Available Soon</span>
                          <span class="vehicle-price">$480/day</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4 vehicle-card-container" data-type="Truck" data-brand="Volvo" data-price="550" data-availability="available" data-location="north">
                <div class="card h-100 vehicle-card">
                    <div class="card-body">
                        <h5 class="vehicle-title">Volvo FMX 460</h5>
                        <img src="images/vehicle/caterpillar_320GC.jpeg" class="vehicle-img rounded mb-3" alt="Volvo FMX 460">
                        <p class="card-text small text-muted">Known for its durability and safety features, used in heavy-duty construction and roadwork.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <span class="badge bg-success badge-availability">Available</span>
                          <span class="vehicle-price">$550/day</span>
                        </div>
                    </div>
                </div>
            </div>
           </div>
          </div>
      </div>
    </div>
  </div>
  
  <footer class="bg-dark text-white pt-5 pb-4">
    <div class="container">
        <div class="row g-4 mb-4">
            <!-- Copyright and social icons -->
            <div class="col-md-6 d-flex align-items-center">
                <p class="mb-0">© 2025 Heavy Duty Hire, Inc. All rights reserved.</p>
            </div>
            
            <div class="col-md-6">
                <ul class="list-unstyled d-flex justify-content-md-end gap-3 mb-0">
                    <li>
                        <a href="#" class="link-light text-decoration-none fs-4" aria-label="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="link-light text-decoration-none fs-4" aria-label="Facebook">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="link-light text-decoration-none fs-4" aria-label="YouTube">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="link-light text-decoration-none fs-4" aria-label="Twitter">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-top border-secondary pt-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <!-- Quick links -->
                <div class="d-flex flex-wrap gap-3 mb-3 mb-md-0">
                    <a href="index.html" class="link-secondary text-decoration-none">Home</a>
                    <a href="about.html" class="link-secondary text-decoration-none">About</a>
                    <a href="vehicle.html" class="link-secondary text-decoration-none">Services</a>
                    <a href="contactus.html" class="link-secondary text-decoration-none">Contact</a>
                    <a href="#" class="link-secondary text-decoration-none">Privacy Policy</a>
                </div>
                
                <!-- Back to top with fa-circle-arrow-up -->
                <a href="#" class="link-secondary text-decoration-none fs-2 back-to-top" aria-label="Back to top">
                    <i class="fa-solid fa-circle-arrow-up"></i>
                </a>
            </div>
        </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // DOM elements
      const priceRange = document.getElementById('priceRange');
      const minPriceInput = document.getElementById('minPrice');
      const maxPriceInput = document.getElementById('maxPrice');
      const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
      const brandCheckboxes = document.querySelectorAll('.brand-checkbox');
      const availabilityRadios = document.querySelectorAll('.availability-radio');
      const locationSelect = document.getElementById('locationSelect');
      const searchFilter = document.getElementById('searchFilter');
      const applyFiltersBtn = document.getElementById('applyFilters');
      const resetFiltersBtn = document.getElementById('resetFilters');
      const resetFiltersNoResults = document.getElementById('resetFiltersNoResults');
      const sortOptions = document.querySelectorAll('.sort-option');
      const vehicleCards = document.querySelectorAll('.vehicle-card-container');
      const resultsCount = document.getElementById('resultsCount');
      const mobileResultsCount = document.getElementById('mobileResultsCount');
      const noResults = document.getElementById('noResults');
      const backToTopBtn = document.querySelector('.back-to-top');
      
      // Current filter state
      let currentFilters = {
        minPrice: 100,
        maxPrice: 10000,
        types: ['Excavator', 'Bulldozer', 'Loader', 'Crane', 'Truck', 'Forklift'],
        brands: ['Caterpillar', 'Komatsu', 'Hitachi', 'Volvo', 'JCB', 'Toyota', 'Doosan'],
        availability: 'available',
        location: 'all',
        searchTerm: '',
        sortBy: 'default'
      };
      
      // Initialize
      initFilters();
      filterVehicles();
      
      // Event listeners
      priceRange.addEventListener('input', function() {
        minPriceInput.value = this.value;
        maxPriceInput.value = 10000;
        currentFilters.minPrice = parseInt(this.value);
        currentFilters.maxPrice = 10000;
      });
      
      minPriceInput.addEventListener('change', function() {
        if (parseInt(this.value) < 100) this.value = 100;
        if (parseInt(this.value) > 10000) this.value = 10000;
        currentFilters.minPrice = parseInt(this.value);
        priceRange.value = this.value;
      });
      
      maxPriceInput.addEventListener('change', function() {
        if (parseInt(this.value) < 100) this.value = 100;
        if (parseInt(this.value) > 10000) this.value = 10000;
        currentFilters.maxPrice = parseInt(this.value);
      });
      
      filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
          updateTypeFilters();
        });
      });
      
      brandCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
          updateBrandFilters();
        });
      });
      
      availabilityRadios.forEach(radio => {
        radio.addEventListener('change', function() {
          currentFilters.availability = this.value;
        });
      });
      
      locationSelect.addEventListener('change', function() {
        currentFilters.location = this.value;
      });
      
      searchFilter.addEventListener('input', function() {
        currentFilters.searchTerm = this.value.toLowerCase();
        filterVehicles();
      });
      
      applyFiltersBtn.addEventListener('click', function() {
        filterVehicles();
      });
      
      resetFiltersBtn.addEventListener('click', resetFilters);
      resetFiltersNoResults.addEventListener('click', resetFilters);
      
      sortOptions.forEach(option => {
        option.addEventListener('click', function(e) {
          e.preventDefault();
          document.getElementById('sortDropdown').textContent = `Sort by: ${this.textContent}`;
          currentFilters.sortBy = this.dataset.sort;
          filterVehicles();
        });
      });
      
      backToTopBtn.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });
      
      // Initialize filter values
      function initFilters() {
        priceRange.value = currentFilters.minPrice;
        minPriceInput.value = currentFilters.minPrice;
        maxPriceInput.value = currentFilters.maxPrice;
        
        filterCheckboxes.forEach(checkbox => {
          checkbox.checked = currentFilters.types.includes(checkbox.value);
        });
        
        brandCheckboxes.forEach(checkbox => {
          checkbox.checked = currentFilters.brands.includes(checkbox.value);
        });
        
        document.querySelector(`.availability-radio[value="${currentFilters.availability}"]`).checked = true;
        locationSelect.value = currentFilters.location;
      }
      
      // Update type filters array
      function updateTypeFilters() {
        currentFilters.types = Array.from(filterCheckboxes)
          .filter(checkbox => checkbox.checked)
          .map(checkbox => checkbox.value);
      }
      
      // Update brand filters array
      function updateBrandFilters() {
        currentFilters.brands = Array.from(brandCheckboxes)
          .filter(checkbox => checkbox.checked)
          .map(checkbox => checkbox.value);
      }
      
      // Filter vehicles based on current filters
      function filterVehicles() {
        let visibleCount = 0;
        
        vehicleCards.forEach(card => {
          const cardPrice = parseInt(card.dataset.price);
          const cardType = card.dataset.type;
          const cardBrand = card.dataset.brand;
          const cardAvailability = card.dataset.availability;
          const cardLocation = card.dataset.location;
          const cardTitle = card.querySelector('.vehicle-title').textContent.toLowerCase();
          const cardText = card.querySelector('.card-text').textContent.toLowerCase();
          
          // Check filters
          const priceMatch = cardPrice >= currentFilters.minPrice && cardPrice <= currentFilters.maxPrice;
          const typeMatch = currentFilters.types.includes(cardType);
          const brandMatch = currentFilters.brands.includes(cardBrand);
          const availabilityMatch = currentFilters.availability === 'all' || 
                                  (currentFilters.availability === 'available' && cardAvailability === 'available') ||
                                  (currentFilters.availability === 'soon' && cardAvailability === 'soon');
          const locationMatch = currentFilters.location === 'all' || cardLocation === currentFilters.location;
          const searchMatch = currentFilters.searchTerm === '' || 
                             cardTitle.includes(currentFilters.searchTerm) || 
                             cardText.includes(currentFilters.searchTerm);
          
          if (priceMatch && typeMatch && brandMatch && availabilityMatch && locationMatch && searchMatch) {
            card.style.display = 'block';
            visibleCount++;
          } else {
            card.style.display = 'none';
          }
        });
        
        // Update results count
        resultsCount.textContent = visibleCount;
        mobileResultsCount.textContent = visibleCount;
        
        // Show/hide no results message
        if (visibleCount === 0) {
          noResults.style.display = 'block';
          document.querySelectorAll('.vehicle-section').forEach(section => {
            section.style.display = 'none';
          });
        } else {
          noResults.style.display = 'none';
          document.querySelectorAll('.vehicle-section').forEach(section => {
            section.style.display = 'block';
          });
        }
        
        // Sort vehicles if needed
        if (currentFilters.sortBy !== 'default') {
          sortVehicles();
        }
      }
      
      // Sort vehicles based on current sort option
      function sortVehicles() {
        const visibleCards = Array.from(document.querySelectorAll('.vehicle-card-container'))
          .filter(card => card.style.display !== 'none');
        
        visibleCards.sort((a, b) => {
          const aPrice = parseInt(a.dataset.price);
          const bPrice = parseInt(b.dataset.price);
          
          switch (currentFilters.sortBy) {
            case 'price-low':
              return aPrice - bPrice;
            case 'price-high':
              return bPrice - aPrice;
            case 'newest':
              // Assuming newer items have higher IDs or some other indicator
              return parseInt(b.dataset.id || 0) - parseInt(a.dataset.id || 0);
            case 'popular':
              // Assuming popularity is stored in a data attribute
              return parseInt(b.dataset.popularity || 0) - parseInt(a.dataset.popularity || 0);
            default:
              return 0;
          }
        });
        
        // Re-insert sorted cards
        visibleCards.forEach((card, index) => {
          const parent = card.parentNode;
          parent.insertBefore(card, parent.children[index]);
        });
      }
      
      // Reset all filters to default
      function resetFilters() {
        currentFilters = {
          minPrice: 100,
          maxPrice: 10000,
          types: ['Excavator', 'Bulldozer', 'Loader', 'Crane', 'Truck', 'Forklift'],
          brands: ['Caterpillar', 'Komatsu', 'Hitachi', 'Volvo', 'JCB', 'Toyota', 'Doosan'],
          availability: 'available',
          location: 'all',
          searchTerm: '',
          sortBy: 'default'
        };
        
        // Update UI to reflect reset
        priceRange.value = currentFilters.minPrice;
        minPriceInput.value = currentFilters.minPrice;
        maxPriceInput.value = currentFilters.maxPrice;
        
        filterCheckboxes.forEach(checkbox => {
          checkbox.checked = currentFilters.types.includes(checkbox.value);
        });
        
        brandCheckboxes.forEach(checkbox => {
          checkbox.checked = currentFilters.brands.includes(checkbox.value);
        });
        
        document.getElementById('availableNow').checked = true;
        locationSelect.value = currentFilters.location;
        searchFilter.value = '';
        document.getElementById('sortDropdown').textContent = 'Sort by: Default';
        
        // Reapply filters
        filterVehicles();
        
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    });
  </script>
</body>
</html>