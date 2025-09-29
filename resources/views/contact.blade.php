@extends('layouts.app')

@section('content')
<!-- Contact Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">Get in Touch</h1>
                <p class="lead mb-4">Ready to start your sustainable energy journey? Contact us for a free consultation.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="mb-4">Send us a Message</h2>
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstName" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="service" class="form-label">Service Interest</label>
                        <select class="form-select" id="service">
                            <option value="">Select a service</option>
                            <option value="energy-audit">Energy Audit</option>
                            <option value="solar-installation">Solar Installation</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="products">Products</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Tell us about your energy needs..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-send me-2"></i>Send Message
                    </button>
                </form>
            </div>
            
            <div class="col-lg-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Contact Information</h4>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-container icon-green me-3">
                                    <i class="bi bi-telephone"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Phone</h6>
                                    <p class="text-muted mb-0">+1 (555) 123-4567</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-container icon-blue me-3">
                                    <i class="bi bi-envelope"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Email</h6>
                                    <p class="text-muted mb-0">info@babienergies.com</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="icon-container icon-yellow me-3">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Address</h6>
                                    <p class="text-muted mb-0">123 Energy Street<br>Green City, GC 12345</p>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h6 class="mb-3">Business Hours</h6>
                        <div class="mb-2">
                            <strong>Monday - Friday:</strong> 8:00 AM - 6:00 PM
                        </div>
                        <div class="mb-2">
                            <strong>Saturday:</strong> 9:00 AM - 4:00 PM
                        </div>
                        <div class="mb-3">
                            <strong>Sunday:</strong> Closed
                        </div>
                        
                        <div class="mt-4">
                            <h6 class="mb-3">Emergency Service</h6>
                            <p class="text-muted small">Available 24/7 for urgent maintenance needs</p>
                            <a href="tel:+15551234567" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-telephone me-1"></i>Emergency: (555) 123-4567
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Areas -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Service Areas</h2>
            <p class="lead text-muted">We proudly serve the following areas</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: var(--primary-color);"></i>
                        <h5 class="card-title mt-3">Green City</h5>
                        <p class="text-muted">Main office location</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: var(--secondary-color);"></i>
                        <h5 class="card-title mt-3">Solar Valley</h5>
                        <p class="text-muted">Full service area</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: var(--warning-color);"></i>
                        <h5 class="card-title mt-3">Eco Town</h5>
                        <p class="text-muted">Installation services</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-geo-alt-fill" style="font-size: 2rem; color: var(--success-color);"></i>
                        <h5 class="card-title mt-3">Clean County</h5>
                        <p class="text-muted">Maintenance services</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="display-5 fw-bold mb-4">Ready to Get Started?</h2>
        <p class="lead mb-4">Schedule your free energy audit today and discover your savings potential.</p>
        <div class="d-flex gap-3 justify-content-center">
            <a href="{{ route('energy-audit') }}" class="btn btn-light btn-lg">
                <i class="bi bi-clipboard-check me-2"></i>Free Energy Audit
            </a>
            <a href="tel:+15551234567" class="btn btn-outline-light btn-lg">
                <i class="bi bi-telephone me-2"></i>Call Now
            </a>
        </div>
    </div>
</section>
@endsection
