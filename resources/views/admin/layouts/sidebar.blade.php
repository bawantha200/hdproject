<div class="col-md-3 col-lg-2 bg-dark text-white p-2 text-center">
                <!-- <hr class="featurette-divider"> -->
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="/dashboard" class="nav-link text-white">Overview</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Bookings</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Vehicles</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Customers</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Payments</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Reports</a></li>
                    <li class="nav-item"><a href="/SliderIndex" class="nav-link text-white">Page Settings</a></li>
                    <li class="nav-item"><a href="/GalleryIndex" class="nav-link text-white">Gallery</a></li>

                    @if(auth()->user()->hasRole('admin'))
                    <!-- Show admin-only menu items -->

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        User Role Managemnet
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav flex-column">
                                    <a class="nav-link" href="/userIndex">Users</a>
                                    <a class="nav-link" href="/roleIndex">Roles</a>
                                    <a class="nav-link" href="/permissionIndex">Permission</a>
                                </nav>
                    </div>
                    @endif
                    
                    <hr class="featurette-divider">
                    <!-- <li><a href="{{ route('logout') }}"><button type="button" class="btn btn-outline-light">Logout</button></a></li> -->
                     <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>