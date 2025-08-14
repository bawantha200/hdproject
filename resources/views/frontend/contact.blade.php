@extends('frontend.layouts.master')

@section('content')
<style>
    .text-danger {
        color: #e72010 !important;
    }    
</style>

 <main>
        <div class="container contact-section">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5 my-5">
                    <h2>Contact Us</h2>
                    <p class="text-muted">Have a question?<br> We're here to help you book your heavy vehicle with ease.</p>
                </div>
            </div>

            <div class="row">
                <!-- Contact Form -->
                <div class="col-md-6 mb-4">
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    <form name="contact-us-form" class="needs-validation" novalidate="" action="{{route('contact.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                            @error('name') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="email@example.com" required>
                            @error('email') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" rows="5" name="message" placeholder="Your message..." required></textarea>
                            @error('message') <span class="text-danger">{{$message}}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="col-md-6 mb-4">
                    <h5>Location Map</h5>
                        <div class="ratio ratio-16x9">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1132.791590199871!2d79.88492763159057!3d7.301682210893256!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2e9acb7249a6f%3A0xf692a22d9db991b0!2sPradeepa%20Engineers!5e0!3m2!1sen!2slk!4v1749977017288!5m2!1sen!2slk" 
                                width="100%" 
                                height="100%" 
                                style="border:1;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>   
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row text-center text-md-start">
                <div class="mx-md-3 my-2">
                    <h5>Our Office</h5>
                    <p class="text-muted">
                    Heavy Duty Hire (Pvt) Ltd.,<br>
                    61 Kirimetiyana, Lunuwila<br>
                    Sri Lanka<br>
                    61100
                    </p>
                </div>

                <div class="mx-md-3 my-2">
                    <h5>Phone</h5>
                    <p class="text-muted">+94 77 123 4567</p>
                </div>

                <div class="mx-md-3 my-2">
                    <h5>Email</h5>
                    <p class="text-muted">support@heavyhire.lk</p>
                </div>
            </div>
        </div>
</main>

    @endsection