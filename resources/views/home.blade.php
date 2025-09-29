@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Power Your Future with Sustainable Energy</h1>
                <p class="lead mb-4">Transform your home or business with our professional solar installation and energy efficiency services. Save money while saving the planet.</p>
                <div class="d-flex gap-3">
                    <a href="{{ route('energy-audit') }}" class="btn btn-light btn-lg">
                        <i class="bi bi-clipboard-check me-2"></i>Get Energy Audit
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-shop me-2"></i>Browse Products
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="text-center">
                    <i class="bi bi-lightning-charge-fill" style="font-size: 8rem; color: rgba(255,255,255,0.3);"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Our Services</h2>
            <p class="lead text-muted">Comprehensive energy solutions for every need</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <div class="icon-container icon-green">
                        <i class="bi bi-clipboard-check" style="font-size: 2rem;"></i>
                    </div>
                    <h4>Energy Audits</h4>
                    <p class="text-muted">Professional energy assessments to identify savings opportunities and improve efficiency.</p>
                    <a href="{{ route('energy-audit') }}" class="btn btn-primary">Learn More</a>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <div class="icon-container icon-blue">
                        <i class="bi bi-sun" style="font-size: 2rem;"></i>
                    </div>
                    <h4>Solar Installation</h4>
                    <p class="text-muted">Complete solar panel installation services with professional warranty and maintenance.</p>
                    <a href="{{ route('solar-installation') }}" class="btn btn-primary">Get Quote</a>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center p-4">
                    <div class="icon-container icon-yellow">
                        <i class="bi bi-tools" style="font-size: 2rem;"></i>
                    </div>
                    <h4>Maintenance</h4>
                    <p class="text-muted">Ongoing maintenance and support to keep your energy systems running efficiently.</p>
                    <a href="{{ route('maintenance') }}" class="btn btn-primary">Schedule Service</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Featured Products</h2>
            <p class="lead text-muted">High-quality energy products for your home</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-solar-panel" style="font-size: 3rem; color: var(--primary-color);"></i>
                        <h5 class="card-title mt-3">Solar Panels</h5>
                        <p class="card-text text-muted">High-efficiency solar panels for maximum energy production.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 text-primary mb-0">From $299</span>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">View</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-battery-charging" style="font-size: 3rem; color: var(--secondary-color);"></i>
                        <h5 class="card-title mt-3">Battery Storage</h5>
                        <p class="card-text text-muted">Store excess solar energy for use during peak hours.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 text-primary mb-0">From $599</span>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">View</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-lightbulb" style="font-size: 3rem; color: var(--warning-color);"></i>
                        <h5 class="card-title mt-3">LED Lighting</h5>
                        <p class="card-text text-muted">Energy-efficient LED lighting solutions for your home.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 text-primary mb-0">From $49</span>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">View</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-thermometer" style="font-size: 3rem; color: var(--danger-color);"></i>
                        <h5 class="card-title mt-3">Smart Thermostats</h5>
                        <p class="card-text text-muted">Intelligent temperature control for optimal energy savings.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 text-primary mb-0">From $199</span>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">View</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-shop me-2"></i>View All Products
            </a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3">
                <div class="mb-3">
                    <i class="bi bi-people-fill" style="font-size: 3rem; color: var(--primary-color);"></i>
                </div>
                <h3 class="fw-bold">500+</h3>
                <p class="text-muted">Happy Customers</p>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <i class="bi bi-house-check" style="font-size: 3rem; color: var(--secondary-color);"></i>
                </div>
                <h3 class="fw-bold">1000+</h3>
                <p class="text-muted">Projects Completed</p>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <i class="bi bi-lightning-charge" style="font-size: 3rem; color: var(--warning-color);"></i>
                </div>
                <h3 class="fw-bold">50MW</h3>
                <p class="text-muted">Solar Installed</p>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <i class="bi bi-award" style="font-size: 3rem; color: var(--success-color);"></i>
                </div>
                <h3 class="fw-bold">15+</h3>
                <p class="text-muted">Years Experience</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="display-5 fw-bold mb-4">Ready to Go Solar?</h2>
        <p class="lead mb-4">Get a free energy audit and discover how much you can save with solar power.</p>
        <a href="{{ route('energy-audit') }}" class="btn btn-light btn-lg">
            <i class="bi bi-clipboard-check me-2"></i>Get Free Energy Audit
        </a>
    </div>
</section>
@endsection