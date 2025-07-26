<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a href="/" class="d-flex align-items-center text-white text-decoration-none">
            <img src="{{asset('frontend/images/logo.jpg')}}" width="50" height="50" class="rounded-circle me-2" alt="Logo">
            <h5 class="mb-0">Heavy Duty Hire</h5>
            </a>

            <div class="text-white fw-bold d-none d-lg-block">
            Dashboard
            </div>

            <!-- <div class="text-white">
            {{Auth::user()->name}}
            </div> -->
            <div class="text-white d-flex align-items-center">
                <span class="me-2">{{ Auth::user()->first_name ?? Auth::user()->name }}</span>
                @if(Auth::user()->roles->count() > 0)
                    <span class="badge bg-light text-dark">
                        {{ Auth::user()->getRoleNames()->first() }}
                    </span>
                @endif
            </div>

        </div>
    </nav>