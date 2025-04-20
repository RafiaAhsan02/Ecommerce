@extends('layouts.frontend.master')

@section('content')
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area mb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <div class="contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="contact-form">
                        <h2>Contact Form</h2>
                        <form class="p-3" method="" action="">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Your Name">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" name="message" id="message" placeholder="Your message here..." rows="5"></textarea>
                            </div>
                            
                            <div class="text-center mb-3">
                                <button class="btn btn-warning" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info">
                        <h3>Get in Touch</h3>
                        <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae nisl eget
                            risus laoreet ultricies vitae eget risus. Vivamus sem tellus, ultricies a libero ut, euismod
                            commodo ipsum. Sed id porttitor diam. Suspendisse porttitor molestie mi.</p>
                        <h4><i class="fa fa-map-marker"></i> 123 News Street, NY, USA</h4>
                        <h4><i class="fa fa-envelope"></i> info@example.com</h4>
                        <h4><i class="fa fa-phone"></i> +123-456-7890</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection