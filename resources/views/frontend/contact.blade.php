@extends('frontend.layouts.app')

@section('title', 'Contact Us - Get in Touch')
@section('meta_description', 'Contact us for any questions, support, or inquiries. We are here to help you.')
@section('meta_keywords', 'contact us, support, customer service, get in touch')

@push('styles')
<style>
.contact-hero {
    background: linear-gradient(135deg, var(--primary-color, #8B7BA8) 0%, var(--accent-color, #A594C4) 50%, var(--dark-purple, #6B4E9D) 100%);
    padding: 80px 0;
    text-align: center;
    color: white;
}

.contact-hero h1 {
    color: white;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.contact-hero .lead {
    color: rgba(255,255,255,0.9);
    text-shadow: 0 1px 2px rgba(0,0,0,0.3);
}

/* Breadcrumb Styling */
.breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "/";
    color: #6c757d;
}

.breadcrumb-item a {
    color: var(--primary-color, #d4af37);
    text-decoration: none;
}

.breadcrumb-item a:hover {
    color: var(--accent-color, #e8c547);
}

.breadcrumb-item.active {
    color: #6c757d;
}

nav[aria-label="breadcrumb"] {
    background: transparent;
    padding: 20px 0;
}

.contact-section {
    padding: 60px 0;
}

.contact-info {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
    text-align: center;
    transition: transform 0.3s ease;
}

.contact-info:hover {
    transform: translateY(-5px);
}

.contact-icon {
    font-size: 3rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.contact-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: var(--secondary-color);
}

.contact-details {
    color: #666;
    line-height: 1.6;
}

.contact-form {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(var(--primary-color-rgb), 0.25);
}

.btn-contact {
    background: var(--primary-color);
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    width: 100%;
}

.btn-contact:hover {
    background: var(--secondary-color);
    color: white;
    transform: translateY(-2px);
}

.map-section {
    background: #f8f9fa;
    padding: 60px 0;
}

.map-container {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.map-container iframe {
    width: 100%;
    height: 400px;
    border: none;
}

.contact-banner {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.description-section {
    background: white;
    padding: 60px 0;
}

.description-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
    text-align: center;
}
</style>
@endpush

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact</li>
        </ol>
    </div>
</nav>

<!-- Hero Section -->
<section class="contact-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if($contactPage && $contactPage->title)
                    <h1 class="display-4 font-weight-bold mb-4">{{ $contactPage->title }}</h1>
                @else
                    <h1 class="display-4 font-weight-bold mb-4">Contact Us</h1>
                @endif
                <p class="lead">We'd love to hear from you. Get in touch with us for any questions or support.</p>
            </div>
        </div>
    </div>
</section>

@if($contactPage)
<!-- Banner Image Section -->
@if($contactPage->banner)
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="{{ asset($contactPage->banner) }}" alt="Contact Us" class="contact-banner">
            </div>
        </div>
    </div>
</section>
@endif

<!-- Description Section -->
@if($contactPage->description)
<section class="description-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="description-content">
                    {!! $contactPage->description !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Contact Information Section -->
<section class="contact-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="font-weight-bold">Get In Touch</h2>
                <p class="lead">Reach out to us through any of the following methods.</p>
            </div>
        </div>
        <div class="row">
            @if($contactPage->email)
            <div class="col-lg-4 col-md-6">
                <div class="contact-info">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3 class="contact-title">Email Address</h3>
                    <div class="contact-details">
                        <a href="mailto:{{ $contactPage->email }}" class="text-decoration-none">{{ $contactPage->email }}</a>
                    </div>
                </div>
            </div>
            @endif
            
            @if($contactPage->phone)
            <div class="col-lg-4 col-md-6">
                <div class="contact-info">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h3 class="contact-title">Phone Number</h3>
                    <div class="contact-details">
                        <a href="tel:{{ $contactPage->phone }}" class="text-decoration-none">{{ $contactPage->phone }}</a>
                    </div>
                </div>
            </div>
            @endif
            
            @if($contactPage->address)
            <div class="col-lg-4 col-md-6">
                <div class="contact-info">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="contact-title">Our Address</h3>
                    <div class="contact-details">
                        {{ $contactPage->address }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="contact-form">
                    <h3 class="text-center mb-4">Send Us a Message</h3>
                    

                    
                    <form action="{{ route('send-contact-message') }}" method="POST" id="contactForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject">Subject <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-contact">
                            <i class="fas fa-paper-plane me-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
@if($contactPage->map)
<section class="map-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mb-5">
                <h2 class="font-weight-bold">Find Us Here</h2>
                <p class="lead">Visit our location or get directions using the map below.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="map-container">
                    @if(strpos($contactPage->map, '<iframe') !== false)
                        {!! $contactPage->map !!}
                    @else
                        <iframe src="{{ $contactPage->map }}" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@else
<!-- No Content Available -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2>Contact Us</h2>
                <p class="lead">Contact information is being updated. Please check back soon.</p>
                
                <!-- Default Contact Form -->
                <div class="contact-form mt-5">
                    <h3 class="mb-4">Send Us a Message</h3>
                    <form action="{{ route('send-contact-message') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject">Subject <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="subject" name="subject" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-contact">
                            <i class="fas fa-paper-plane me-2"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
// Contact form handling
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            // Add any custom form validation or handling here
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(function(field) {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    }
    
    // Remove invalid class on input
    const formInputs = document.querySelectorAll('.form-control');
    formInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    });
});
</script>
@endpush