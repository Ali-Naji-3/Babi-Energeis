@extends('layouts.app')

@section('content')
<!-- Maintenance Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4">Maintenance Services</h1>
                <p class="lead mb-4">Keep your energy systems running at peak performance with our professional maintenance services.</p>
                <a href="#schedule-maintenance" class="btn btn-light btn-lg">
                    <i class="bi bi-tools me-2"></i>Schedule Maintenance
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Maintenance Services -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Our Maintenance Services</h2>
            <p class="lead text-muted">Comprehensive maintenance for all your energy systems</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="icon-container icon-green mx-auto mb-3">
                            <i class="bi bi-sun"></i>
                        </div>
                        <h4>Solar Panel Maintenance</h4>
                        <p class="text-muted">Regular cleaning, inspection, and performance optimization for your solar panels.</p>
                        <ul class="list-unstyled text-start">
                            <li><i class="bi bi-check-circle text-success me-2"></i>Panel cleaning</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Performance monitoring</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Inverter inspection</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Connection checks</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="icon-container icon-blue mx-auto mb-3">
                            <i class="bi bi-battery-charging"></i>
                        </div>
                        <h4>Battery System Maintenance</h4>
                        <p class="text-muted">Keep your energy storage systems running efficiently with regular maintenance.</p>
                        <ul class="list-unstyled text-start">
                            <li><i class="bi bi-check-circle text-success me-2"></i>Battery health checks</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Charge optimization</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Temperature monitoring</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Connection maintenance</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <div class="icon-container icon-yellow mx-auto mb-3">
                            <i class="bi bi-lightning-charge"></i>
                        </div>
                        <h4>System Optimization</h4>
                        <p class="text-muted">Maximize your energy system's performance with regular optimization services.</p>
                        <ul class="list-unstyled text-start">
                            <li><i class="bi bi-check-circle text-success me-2"></i>Performance analysis</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Efficiency improvements</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Software updates</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Monitoring setup</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Maintenance Plans -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Maintenance Plans</h2>
            <p class="lead text-muted">Choose the maintenance plan that fits your needs</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h4 class="card-title">Basic Plan</h4>
                        <div class="mb-3">
                            <span class="h2 text-primary">$99</span>
                            <span class="text-muted">/year</span>
                        </div>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check text-success me-2"></i>Annual inspection</li>
                            <li><i class="bi bi-check text-success me-2"></i>Basic cleaning</li>
                            <li><i class="bi bi-check text-success me-2"></i>Performance report</li>
                            <li><i class="bi bi-check text-success me-2"></i>Email support</li>
                        </ul>
                        <button class="btn btn-outline-primary w-100">Choose Plan</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-primary">
                    <div class="card-body text-center">
                        <div class="badge bg-primary mb-3">Most Popular</div>
                        <h4 class="card-title">Standard Plan</h4>
                        <div class="mb-3">
                            <span class="h2 text-primary">$199</span>
                            <span class="text-muted">/year</span>
                        </div>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check text-success me-2"></i>Bi-annual inspection</li>
                            <li><i class="bi bi-check text-success me-2"></i>Deep cleaning</li>
                            <li><i class="bi bi-check text-success me-2"></i>Performance optimization</li>
                            <li><i class="bi bi-check text-success me-2"></i>Priority support</li>
                            <li><i class="bi bi-check text-success me-2"></i>Emergency service</li>
                        </ul>
                        <button class="btn btn-primary w-100">Choose Plan</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h4 class="card-title">Premium Plan</h4>
                        <div class="mb-3">
                            <span class="h2 text-primary">$299</span>
                            <span class="text-muted">/year</span>
                        </div>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check text-success me-2"></i>Quarterly inspection</li>
                            <li><i class="bi bi-check text-success me-2"></i>Professional cleaning</li>
                            <li><i class="bi bi-check text-success me-2"></i>Advanced optimization</li>
                            <li><i class="bi bi-check text-success me-2"></i>24/7 monitoring</li>
                            <li><i class="bi bi-check text-success me-2"></i>Same-day service</li>
                            <li><i class="bi bi-check text-success me-2"></i>Parts & labor included</li>
                        </ul>
                        <button class="btn btn-outline-primary w-100">Choose Plan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Schedule Maintenance Form -->
<section id="schedule-maintenance" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h2 class="display-6 fw-bold">Schedule Maintenance</h2>
                            <p class="lead text-muted">Book your maintenance service today</p>
                        </div>
                        
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
                                    <input type="tel" class="form-control" id="phone" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Property Address</label>
                                <textarea class="form-control" id="address" rows="2" required></textarea>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="serviceType" class="form-label">Service Type</label>
                                    <select class="form-select" id="serviceType" required>
                                        <option value="">Select service</option>
                                        <option value="routine">Routine Maintenance</option>
                                        <option value="repair">Repair Service</option>
                                        <option value="inspection">System Inspection</option>
                                        <option value="emergency">Emergency Service</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="systemType" class="form-label">System Type</label>
                                    <select class="form-select" id="systemType" required>
                                        <option value="">Select system</option>
                                        <option value="solar">Solar Panels</option>
                                        <option value="battery">Battery Storage</option>
                                        <option value="inverter">Inverter</option>
                                        <option value="monitoring">Monitoring System</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="preferredDate" class="form-label">Preferred Date</label>
                                    <input type="date" class="form-control" id="preferredDate" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="preferredTime" class="form-label">Preferred Time</label>
                                    <select class="form-select" id="preferredTime" required>
                                        <option value="">Select time</option>
                                        <option value="morning">Morning (8 AM - 12 PM)</option>
                                        <option value="afternoon">Afternoon (12 PM - 5 PM)</option>
                                        <option value="evening">Evening (5 PM - 8 PM)</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="issues" class="form-label">Describe any issues or concerns</label>
                                <textarea class="form-control" id="issues" rows="3" placeholder="Tell us about any problems you're experiencing or specific maintenance needs..."></textarea>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-calendar-check me-2"></i>Schedule Maintenance
                                </button>
                                <p class="text-muted mt-3 small">
                                    <i class="bi bi-shield-check me-1"></i>
                                    Professional service guaranteed. Emergency service available 24/7.
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Emergency Service -->
<section class="py-5 bg-danger text-white">
    <div class="container text-center">
        <h2 class="display-5 fw-bold mb-4">Emergency Service Available</h2>
        <p class="lead mb-4">Need immediate assistance? Our emergency service team is available 24/7.</p>
        <a href="tel:+15551234567" class="btn btn-light btn-lg">
            <i class="bi bi-telephone me-2"></i>Call Emergency: (555) 123-4567
        </a>
    </div>
</section>
@endsection
